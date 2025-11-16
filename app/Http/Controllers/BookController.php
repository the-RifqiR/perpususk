<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Kategori;
use App\Models\RequestPeminjaman;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{

    // Ambil data buku dengan relasi kategori 
    public function index()
    {
        $books = Book::with('kategori')->get();
        return view('books.index', compact('books'));
    }

    public function pengunjungDashboard()
    {
        $books = Book::all();

        $userRequests = RequestPeminjaman::where('user_id', Auth::id())->whereIn('status', ['pending', 'approved'])->get()->keyBy('book_id');
        return view('books.list',  compact('books', 'userRequests'));
    }

    public function public()
    {
        $books = Book::all();

        $userRequests = RequestPeminjaman::where('user_id', Auth::id())->whereIn('status', ['pending', 'approved'])->get()->keyBy('book_id');
        return view('books.list', compact('books', 'userRequests'));
    }


    // Kirim data kategori ke form create
    public function create()
    {
        $kategori = Kategori::all();
        return view('books.create', compact('kategori'));
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'nullable|date',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'nullable|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
        }

        Book::create($validated);

        return redirect()->route('petugas.index');
    }

    // kirim data book dan kategori ke halaman edit
    public function edit(Book $book)
    {
        $kategori = Kategori::all();
        return view('books.edit', compact('book', 'kategori'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer|min:0',
            'id_kategori' => 'nullable|exists:kategoris,id',
            'gambar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // hapus gambar lama jika ada
            if ($book->gambar && Storage::disk('public')->exists($book->gambar)) {
                Storage::disk('public')->delete($book->gambar);
            }


            $validated['gambar'] = $request->file('gambar')->store('buku', 'public');
        } else {
            // jika tidak ada file baru, pastikan kita tidak menimpa field gambar menjadi null
            unset($validated['gambar']);
        }


        $book->update($validated);

        return redirect()->route('petugas.index');
    }


    public function destroy(Book $book)
    {
        $book->delete();
        return back();
    }
}
