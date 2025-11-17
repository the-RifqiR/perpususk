@extends('layouts.app')

@section('title', 'Daftar Request Peminjaman')

@section('content')
<div>
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Manajemen Request Peminjaman</h1>
        <p class="text-gray-600 mt-2">Proses dan kelola semua permintaan peminjaman buku dari pengunjung</p>
    </div>


    {{-- Table --}}
    <div class="rounded-lg border border-gray-300 overflow-hidden bg-white mb-10">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-300">
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">No</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Pengunjung</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Buku</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Request</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Keterangan Pengunjung</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Status Request</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($requests as $req)
                    <tr class="border-b border-gray-300 hover:bg-gray-100">
                        <td class="px-6 py-4 border-r">{{ $loop->iteration }}</td>

                        <td class="px-6 py-4 border-r">
                            <p class="font-medium text-gray-900">{{ $req->user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $req->user->email }}</p>
                        </td>

                        <td class="px-6 py-4 border-r">{{ $req->book->judul }}</td>

                        <td class="px-6 py-4 border-r">{{ $req->created_at->format('d M Y H:i') }}</td>
                    
                        <td class="px-6 py-4 border-r">{{ $req->tanggal_kembali->format('d M Y H:i') }}</td>

                        <td class="px-6 py-4 border-r">{{ $req->keterangan }}</td>

                        <td class="px-6 py-4 border-r">
                            @if($req->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-50 text-yellow-700 border border-yellow-300 rounded-full text-xs font-medium shadow-sm">
                                Menunggu
                            </span>
                            @elseif($req->status === 'approved')
                            <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-300 rounded-full text-xs font-medium shadow-sm">
                                Disetujui
                            </span>
                            @elseif($req->status === 'returned')
                            <span class="px-3 py-1 bg-blue-50 text-blue-700 border border-blue-300 rounded-full text-xs font-medium shadow-sm">
                                Dikembalikan
                            </span>
                            @else
                            <span class="px-3 py-1 bg-red-50 text-red-700 border border-red-300 rounded-full text-xs font-medium shadow-sm">
                                Ditolak
                            </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($req->status === 'pending')
                            <form action="{{ route('requests.updateStatus', $req->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button class="px-3 py-1.5 bg-green-600 text-white rounded text-sm hover:bg-green-700 mr-2">
                                    Terima
                                </button>
                            </form>

                            <form action="{{ route('requests.updateStatus', $req->id) }}" method="POST" class="inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button class="px-3 py-1.5 bg-red-600 text-white rounded text-sm hover:bg-red-700">
                                    Tolak
                                </button>
                            </form>
                            @elseif($req->status === 'returned')
                            <span class="text-gray-500 italic text-sm">Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            <p class="text-gray-600">Tidak ada request peminjaman</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection