@extends('layouts.app')

@section('title', 'Buat Buku')

@section('content')

<div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md shadow-sm">
    <h1 class="text-xl font-bold text-black mb-4">Buat Buku</h1>

    <form action="{{ route('petugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf


        <div>
            <label for="judul" class="block text-black mb-1">Judul Buku</label>
            <input type="text" name="judul" id="judul"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition"
                value="{{ old('judul') }}">
        </div>


        <div>
            <label for="deskripsi" class="block text-black mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition bg-white">{{ old('deskripsi') }}</textarea>
        </div>


        <div>
            <label for="penulis" class="block text-black mb-1">Penulis</label>
            <input type="text" name="penulis" id="penulis"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition"
                value="{{ old('penulis') }}">
        </div>


        <div>
            <label for="tahun_terbit" class="block text-black mb-1">Tanggal & Tahun Terbit</label>
            <input type="date" name="tahun_terbit" id="tahun_terbit"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition"
                value="{{ old('tahun_terbit') }}">
        </div>


        <div>
            <label for="stok" class="block text-black mb-1">Stok</label>
            <input type="number" name="stok" id="stok" min="0"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition"
                value="{{ old('stok') }}">
        </div>


        <div>
            <label for="id_kategori" class="block text-black mb-1">Kategori</label>
            <select name="id_kategori" id="id_kategori"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $kat)
                <option value="{{ $kat->id }}" {{ old('id_kategori') == $kat->id ? 'selected' : '' }}>
                    {{ $kat->nama }}
                </option>
                @endforeach
            </select>
        </div>


        <div>
            <label for="gambar" class="block text-black mb-1">Gambar Buku</label>
            <input type="file" name="gambar" id="gambar"
                class="w-full border border-black rounded-md p-2 focus:outline-none hover:border-gray-700 transition bg-white">
        </div>

        <!-- Tombol Simpan -->
        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
            Simpan
        </button>
        <a href="{{route('petugas.index')}}" class="inline-block px-4 py-2 border-2 border-gray-800 text-gray-900 font-semibold rounded-md 
          hover:bg-gray-100 transition">
            ← Kembali
        </a>
    </form>
</div>
@endsection