@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md">
    <h1 class="text-xl font-bold text-black mb-4">Edit Buku</h1>

    <form action="{{ route('petugas.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-black mb-1">Judul Buku</label>
            <input type="text" name="judul" id="judul"
                value="{{ old('judul', $book->judul) }}"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-black mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">{{ old('deskripsi', $book->deskripsi) }}</textarea>
        </div>

        <!-- Penulis -->
        <div>
            <label for="penulis" class="block text-black mb-1">Penulis</label>
            <input type="text" name="penulis" id="penulis"
                value="{{ old('penulis', $book->penulis) }}"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <!-- Tahun Terbit -->
        <div>
            <label for="tahun_terbit" class="block text-black mb-1">Tanggal & Tahun Terbit</label>
            <input type="date" name="tahun_terbit" id="tahun_terbit"
                value="{{ old('tahun_terbit', $book->tahun_terbit) }}"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <!-- Stok -->
        <div>
            <label for="stok" class="block text-black mb-1">Stok</label>
            <input type="number" name="stok" id="stok" min="0"
                value="{{ old('stok', $book->stok) }}"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <!-- Kategori -->
        <div>
            <label for="id_kategori" class="block text-black mb-1">Kategori</label>
            <select name="id_kategori" id="id_kategori"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('id_kategori', $book->id_kategori) == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Gambar Buku -->
        <div>
            <label for="gambar" class="block text-black mb-1">Gambar Buku</label>
            @if($book->gambar || $book->gambar_url)
            <img src="{{ $book->gambar_url ? $book->gambar_url : asset('storage/'.$book->gambar) }}"
                class="w-24 h-24 object-cover border rounded mb-3">
            @endif

            <input type="file" name="gambar"
                class="w-full border border-black rounded-md p-2 bg-white mb-3">

            <input type="url" name="gambar_url"
                value="{{ old('gambar_url', $book->gambar_url) }}"
                placeholder="https://contoh.com/gambar.jpg"
                class="w-full px-3 py-2 border border-black rounded-md bg-white">

            <small class="text-gray-600 text-sm">
                Isi URL jika ingin mengganti dengan gambar dari internet
            </small>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection