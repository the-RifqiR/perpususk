@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">📚 Katalog Buku</h1>
        <p class="text-gray-600">Temukan buku favorit Anda dan ajukan peminjaman</p>
    </div>

    {{-- Books Grid --}}
    @if($books->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($books as $book)
        <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            {{-- Book Image --}}
            <div class="relative h-48 bg-gray-200 overflow-hidden">
                <img
                    src="{{ $book->gambar_url ? $book->gambar_url : asset('storage/'.$book->gambar) }}"
                    alt="{{ $book->judul }}"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                {{-- Stock Badge --}}
                <div class="absolute top-2 right-2">
                    @if($book->stok > 5)
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Stok Banyak:: {{$book->stok}}
                    </span>
                    @elseif($book->stok > 0)
                    <span class="bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Stok Terbatas: {{$book->stok}}
                    </span>
                    @else
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                        Habis
                    </span>
                    @endif
                </div>
            </div>

            {{-- Book Info --}}
            <div class="p-4">
                <h3 class="font-semibold text-gray-900 line-clamp-2 mb-2">{{ $book->judul }}</h3>

                <div class="space-y-1 mb-4 text-sm text-gray-600">
                    <p><i class="fas fa-pen w-4"></i> {{ $book->penulis }}</p>
                    <p><i class="fas fa-calendar w-4"></i> {{ $book->tahun_terbit }}</p>
                    @if($book->kategori)
                    <p><i class="fas fa-tag w-4"></i> {{ $book->kategori->nama }}</p>
                    @endif
                </div>

                {{-- Status / Action --}}
                <div class="mt-4">
                    @auth
                    @if(Auth::user()->role === 'pengunjung')
                    @php
                    $request = $userRequests[$book->id] ?? null;
                    @endphp

                    @if(!$request)
                    @if($book->stok > 0)
                    <a
                        href="{{ route('requests.create', $book->id) }}"
                        class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700">
                        <i class="fas fa-book-reader mr-2"></i>Pinjam
                    </a>
                    @else
                    <button
                        disabled
                        class="w-full bg-gray-300 text-gray-600 py-2 rounded-lg font-medium cursor-not-allowed">
                        <i class="fas fa-ban mr-2"></i>Stok Habis
                    </button>
                    @endif
                    @elseif($request->status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <p class="text-sm text-yellow-800 font-medium">
                            <i class="fas fa-hourglass-half mr-2"></i>Menunggu Persetujuan
                        </p>
                        <p class="text-xs text-yellow-700 mt-1">
                            Diajukan: {{ $request->created_at->format('d M Y') }}
                        </p>
                    </div>
                    @elseif($request->status === 'approved')
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                        <p class="text-sm text-green-800 font-medium">
                            <i class="fas fa-check-circle mr-2"></i>Sedang Dipinjam
                        </p>
                        <p class="text-xs text-green-700 mt-1">
                            Kembali: {{ $request->tanggal_kembali }}
                        </p>
                    </div>
                    @endif
                    @endif
                    @else
                    <p class="text-sm text-gray-500 text-center py-2">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> untuk meminjam
                    </p>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
    {{$books->links()}}
    </div>
    @else
    {{-- Empty State --}}
    <div class="text-center py-12">
        <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">Buku tidak ditemukan</h3>
        <p class="text-gray-600">Coba ubah filter atau cari dengan kata kunci lain</p>
    </div>
    @endif
</div>
@endsection