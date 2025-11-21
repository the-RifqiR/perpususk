@extends('layouts.petugas.main')

@section('title', 'Edit Kategori')

@section('content')
<div class="min-h-screen">

    <div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md">
        <h1 class="text-xl font-bold text-black mb-4">Buat Kategori</h1>

        <form action="{{ route('kategori.update', $kategori) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label for="name" class="block text-black mb-1">Nama Kategori</label>
                <input type="text" name="nama" id="name" value="{{old('nama', $kategori->nama)}}"
                    class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
            </div>

            <button type="submit"
                class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection