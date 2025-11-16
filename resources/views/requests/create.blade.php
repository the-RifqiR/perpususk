@extends('layouts.app')

@section('title', 'Request Peminjaman')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md shadow-sm">
    <h1 class="text-xl font-bold text-black mb-4">📖 Request Peminjaman Buku</h1>

    <form action="{{ route('requests.store', $book) }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-black mb-1">Judul Buku</label>
            <input type="text" value="{{ $book->judul }}" readonly
                class="w-full px-3 py-2 border border-black bg-gray-100 rounded-md">
            <input type="hidden" name="id_books" value="{{ $book->id }}">
        </div>

        @php
        use Carbon\Carbon;
        @endphp
        <div>
            <label for="tanggal_kembali" class="block text-black mb-1">Tanggal Kembali</label>
            {{ Carbon::now()->addDays(14)->format('d-m-Y') }}
        </div>

        <div>
            <label class="block text-black mb-1">Keterangan</label>
            <input type="text" name="keterangan"
                class="w-full px-3 py-2 border border-black bg-gray-100 rounded-md">
        </div>


        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
            Kirim Request
        </button>
        <a href="{{route('books.list')}}" class="inline-block px-4 py-2 border-2 border-gray-800 text-gray-900 font-semibold rounded-md 
          hover:bg-gray-100 transition">
            ← Kembali
        </a>
    </form>
</div>
@endsection