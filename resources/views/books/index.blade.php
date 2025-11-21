@extends('layouts.petugas.main')

@section('title', 'Manajemen Buku')

@section('content')
<div class="min-h-screen">

    {{-- Header --}}
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Buku</h1>
            <p class="text-gray-600 mt-2">Kelola koleksi buku perpustakaan</p>
        </div>

        <a href="{{ route('petugas.create') }}"
            class="px-4 py-2 bg-neutral-950 text-white rounded-lg font-medium hover:bg-neutral-500 flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Buat Buku</span>
        </a>
    </div>

    {{-- Table --}}
    <div class="rounded-lg border border-gray-300 overflow-hidden bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-300">
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Gambar</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Judul</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Deskripsi</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Penulis</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Kategori</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal & Tahun</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-900 border-r">Stok</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($books as $book)
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="px-6 py-4 border-r">{{ $books->firstItem() + $loop->index }}</td>

                        <td class="px-6 py-4 border-r">
                            @if ($book->gambar_url)
                            <img src="{{ $book->gambar_url }}" ...>
                            @elseif($book->gambar)
                            <img src="{{ asset('storage/'.$book->gambar) }}" ...>
                            @else
                            <div class="w-12 h-16 bg-gray-200 border rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-500"></i>
                            </div>
                            @endif
                        </td>

                        <td class="px-6 py-4 border-r">
                            <p class="font-medium text-gray-900 line-clamp-2">{{ $book->judul }}</p>
                        </td>

                        <td class="px-6 py-4 border-r">
                            <p class="text-xs text-gray-900 line-clamp-1">{{ $book->deskripsi }}</p>
                        </td>

                        <td class="px-6 py-4 border-r">{{ $book->penulis }}</td>

                        <td class="px-6 py-4 border-r">
                            <span class="px-2 py-1 border border-gray-700 text-gray-800 text-xs rounded">
                                {{ $book->kategori->nama ?? '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 border-r">{{ $book->tahun_terbit }}</td>

                        <td class="px-6 py-4 text-center border-r">
                            <span class="px-3 py-1 border border-gray-700 text-gray-800 text-xs rounded">
                                {{ $book->stok > 0 ? $book->stok : 'Habis' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 flex justify-center items-center gap-2"">
                            <a href=" {{ route('petugas.edit', $book) }}"
                            class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 inline-flex items-center">
                            <i class="fas fa-edit mr-1"></i>Edit
                            </a>

                            <form action="{{ route('petugas.destroy', $book) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                    <i class="fas fa-trash mr-1"></i>Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600">Tidak ada data buku</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $books->links() }}
        </div>
    </div>

</div>
@endsection