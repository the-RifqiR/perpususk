@extends('layouts.petugas.main')

@section('title', 'Buat Kategori')

@section('content')
<div class="min-h-screen">

    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md">
        <h1 class="text-xl font-bold text-black mb-4">Buat Kategori</h1>

        <form action="{{ route('kategori.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-black mb-1">Nama Kategori</label>
                <input type="text" name="nama" id="name"
                    class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
            </div>

            <button type="submit"
                class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
                Simpan
            </button>
            <a href="{{route('kategori.index')}}" class="inline-block px-4 py-2 border-2 border-gray-800 text-gray-900 font-semibold rounded-md 
          hover:bg-gray-100 transition">
                ← Kembali
            </a>
        </form>
    </div>
</div>
@endsection