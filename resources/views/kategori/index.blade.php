@extends('layouts.petugas.main')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="min-h-screen">

    <div>
        {{-- Header --}}
        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Kategori</h1>
                <p class="text-gray-600 mt-2">Kelola kategori buku di perpustakaan</p>
            </div>
            <a href="{{ route('kategori.create') }}"
                class="px-4 py-2 bg-neutral-950 text-white rounded-lg font-medium hover:bg-neutral-500 flex items-center space-x-2">
                <i class="fas fa-plus"></i>
                <span>Buat Kategori</span>
            </a>
        </div>



        {{-- Table Kategori --}}
        <div class="rounded-lg border border-gray-300 overflow-hidden bg-white mb-10">
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-300">
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">No</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Nama Kategori</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Jumlah Buku</th>
                            <th class="px-6 py-3 text-center font-semibold text-gray-900">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($kategoris as $k)
                        <tr class="border-b border-gray-300 hover:bg-gray-100">

                            <td class="px-6 py-4 border-r">{{ $kategoris->firstItem() + $loop->index }}</td>

                            <td class="px-6 py-4 border-r">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-lg border border-gray-400 flex items-center justify-center text-gray-700">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $k->nama }}</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 border-r">
                                <span class="px-3 py-1 border border-blue-700 text-blue-800 rounded-full text-xs font-semibold">
                                    {{ $k->books->count() }} Buku
                                </span>
                            </td>

                            <td class="px-6 py-4 text-center space-x-2">
                                <a href="{{ route('kategori.edit', $k) }}"
                                    class="px-3 py-1.5 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 inline-block">
                                    Edit
                                </a>

                                <form action="{{ route('kategori.destroy', $k) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center">
                                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                                <p class="text-gray-600">Tidak ada data kategori</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$kategoris->links()}}
            </div>
        </div>

    </div>
    @endsection