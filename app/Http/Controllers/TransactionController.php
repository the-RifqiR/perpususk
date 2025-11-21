<?php

namespace App\Http\Controllers;

use App\Models\RequestPeminjaman;
use App\Models\Transaction;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Petugas lihat semua transaksi
    public function index()
    {
        $transactions = Transaction::with(['pengunjung', 'book', 'request'])->latest()->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function pengunjungDashboard()
    {
        $transactions = Transaction::where('users_id_pengunjung', Auth::id())->with(['book', 'pengunjung', 'petugas'])->latest()->paginate(15);

        return view('transactions.list', compact('transactions'));
    }

    // Ubah status menjadi dikembalikan
    public function updateStatus(Transaction $transaction)
    {
        try {
            DB::transaction(function () use ($transaction) {
                // Lock book row to prevent race conditions
                $book = Book::where('id', $transaction->id_book)->lockForUpdate()->first();

                // Update transaction
                $transaction->update([
                    'status' => 'dikembalikan',
                    'tanggal_dikembalikan' => now(),
                ]);

                // Increment stok jika buku ada
                if ($book) {
                    $book->increment('stok');
                }

                // Update related request status
                if ($transaction->request_id) {
                    $request = RequestPeminjaman::find($transaction->request_id);
                    if ($request) {
                        $request->update(['status' => 'selesai']);
                    }
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memproses pengembalian: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Buku telah dikembalikan.');
    }
}
