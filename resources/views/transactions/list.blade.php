@extends('layouts.app')

@section('title', 'Dashboard Transaksi Pengunjung')

@section('content')
<div class="min-h-screen">
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Transaksi</h1>
        <p class="text-gray-600 mt-2">Pantau semua peminjaman dan pengembalian buku anda</p>
    </div>

    {{-- Table --}}
    <div>

        <div class="rounded-lg border border-gray-300 overflow-hidden bg-white">
            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-white border-b border-gray-300">
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">ID</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Pengunjung</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Petugas Menangani</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Buku</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Pinjam</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Kembali</th>
                            <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Status Peminjaman</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($transactions as $t)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4 border-r">{{ $transactions->firstItem() + $loop->index }}</td>

                            <td class="px-6 py-4 border-r">
                                <p class="font-medium text-gray-900">{{ $t->pengunjung->name }}</p>
                                <p class="text-xs text-gray-500">{{ $t->pengunjung->username ?? '-' }}</p>
                            </td>

                            <td class="px-6 py-4 border-r">
                                <p class="font-medium text-gray-900">{{ $t->petugas->name }}</p>
                                <p class="text-xs text-gray-500">{{ $t->petugas->username ?? '-' }}</p>
                            </td>

                            <td class="px-6 py-4 border-r">{{ $t->book?->judul ?? '⚠️ Buku Terhapus' }}</td>

                            <td class="px-6 py-4 border-r">{{ $t->tanggal_dipinjam?->format('d M Y') }}</td>

                            <td class="px-6 py-4 border-r">
                                <span class="{{ $t->is_late ? 'text-red-600 font-semibold' : '' }}">
                                    {{ $t->tanggal_kembali?->format('d M Y') }}
                                </span>
                            </td>

                            <td class="px-6 py-4 border-r">
                                @if($t->status === 'dipinjam')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Dipinjam</span>
                                @else
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Dikembalikan</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-600">
                                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                                <p>Tidak ada data transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$transactions->links()}}
            </div>
        </div>
    </div>
</div>
@endsection