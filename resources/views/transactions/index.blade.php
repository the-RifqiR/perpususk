@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Transaksi</h1>
        <p class="text-gray-600 mt-2">Pantau dan kelola semua peminjaman dan pengembalian buku</p>
    </div>

    {{-- Table --}}
    <div class="rounded-lg border border-gray-300 overflow-hidden bg-white">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-300">
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">#</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Pengunjung</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Buku</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Dikembalikan</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Status</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($transactions as $t)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 border-r">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4 border-r">
                            <p class="font-medium text-gray-900">{{ $t->pengunjung->name }}</p>
                            <p class="text-xs text-gray-500">{{ $t->pengunjung->username ?? '-' }}</p>
                        </td>

                        <td class="px-6 py-4 border-r">{{ $t->book?->judul ?? '⚠️ Buku Terhapus' }}</td>

                        <td class="px-6 py-4 border-r">{{ $t->tanggal_dipinjam?->format('d M Y') }}</td>

                        <td class="px-6 py-4 border-r">
                            <span class="{{ $t->is_late ? 'text-red-600 font-semibold' : '' }}">
                                {{ $t->tanggal_kembali?->format('d M Y') }}
                            </span>
                        </td>

                        <td class="px-6 py-4 border-r">{{ $t->tanggal_dikembalikan?->format('d M Y') ?? '-' }}</td>

                        <td class="px-6 py-4 border-r">
                            @if($t->status === 'dipinjam')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">Dipinjam</span>
                            @else
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Dikembalikan</span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($t->status === 'dipinjam')
                            <form action="{{ route('transactions.return', $t->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                                    Dikembalikan
                                </button>
                            </form>
                            @else
                            <span class="text-gray-500 italic">Selesai</span>
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
        </div>
    </div>
</div>
@endsection