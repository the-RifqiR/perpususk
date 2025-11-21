<?php

namespace App\Http\Controllers;

use App\Models\RequestPeminjaman;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RequestPeminjamanController extends Controller
{
    // kirim 
    public function index()
    {
        $requests = RequestPeminjaman::with(['user', 'book'])->latest()->paginate(15);
        return view('requests.index', compact('requests'));
    }

    public function create($book_id)
    {
        $book = Book::findOrFail($book_id);
        return view('requests.create', compact('book'));
    }

    public function store(Request $request, $book_id)
    {
        // Check id buku
        $book = Book::findOrFail($book_id);

        if(Auth::user()->role !== 'pengunjung'){
            abort(403);
        }

        // Validasi input sederhana
        $request->validate([
            'keterangan' => 'nullable|string|max:500',
            'tanggal_kembali' => 'nullable|date|after:today',
        ]);

        // Cegah duplikasi request: tidak boleh ada request pending/approved untuk user yang sama pada buku yang sama
        $exists = RequestPeminjaman::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
        
        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah memiliki permintaan untuk buku ini yang sedang diproses.');
        }

        // Cegah request jika stok habis
        if ($book->stok <= 0) {
            return redirect()->back()->with('error', 'Stok buku saat ini habis.');
        }

        // Buat request peminjaman
        RequestPeminjaman::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'status' => 'pending',
            'keterangan' => $request->input('keterangan'),
            'tanggal_kembali' => Carbon::now()->addDays(14),
        ]);

        return redirect()->route('books.list')->with('success', 'Permintaan peminjaman telah diajukan.');
    }


    public function updateStatus(Request $request, RequestPeminjaman $req)
    {
        // Jika status berubah menjadi approved, kita lakukan operasi stok + pembuatan transaksi di dalam DB transaction
        if ($request->status === 'approved') {
            try {
                DB::transaction(function () use ($req, $request) {
                    // Lock baris buku untuk mencegah race condition
                    $book = Book::where('id', $req->book_id)->lockForUpdate()->first();

                    if (!$book || $book->stok <= 0) {
                        throw new \Exception('Stok Habis');
                    }

                    // Kurangi stok secara atomik
                    $book->decrement('stok');

                    // Update status request
                    $req->update(['status' => $request->status]);

                    // Buat transaksi peminjaman
                    Transaction::create([
                        'request_id' => $req->id,
                        'id_pengunjung' => $req->user_id,
                        'id_petugas' => Auth::id(),
                        'id_book' => $req->book_id,
                        'tanggal_dipinjam' => now(),
                        'tanggal_kembali' => Carbon::now()->addDays(14),
                        'status' => 'dipinjam',
                    ]);
                });
            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        } else {
            // Untuk perubahan status selain approved, hanya update status
            $req->update([
                'status' => $request->status,
            ]);
        }

        return redirect()->back()->with('success', 'Status permintaan diperbarui.');
    }
}
