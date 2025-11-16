@extends('layouts.app')

@section('title', 'Buat Akun')

@section('content')
<div class="min-h-screen">
    {{-- Header --}}
    <div class="mb-8 flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Manajemen Pengguna</h1>
            <p class="text-gray-600 mt-2">Kelola akun pengguna dan role akses sistem</p>
        </div>
        <a href="{{ route('users.create') }}"
            class="px-4 py-2 bg-neutral-950 text-white rounded-lg font-medium hover:bg-neutral-500 flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Buat Akun</span>
        </a>
    </div>

    {{-- Table --}}
    <div class="rounded-lg border border-gray-300 overflow-hidden bg-white mt-6">
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">
                <thead>
                    <tr class="bg-white border-b border-gray-300">
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">ID</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Nama</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Username</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-900 border-r">Role</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-900">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $u)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="px-6 py-4 border-r">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 border-r">{{ $u->name }}</td>
                        <td class="px-6 py-4 border-r">{{ $u->username }}</td>
                        <td class="px-6 py-4 border-r">
                            @if($u->role === 'petugas')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                Petugas
                            </span>
                            @else
                            <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                Pengunjung
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <form action="{{ route('users.destroy', $u) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($users->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-8 text-gray-500">
                            <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                            Tidak ada data pengguna
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection