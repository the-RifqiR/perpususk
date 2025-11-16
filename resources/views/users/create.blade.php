@extends('layouts.app')

@section('title', 'Buat Akun')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-white border border-black rounded-md">
    <h1 class="text-xl font-bold text-black mb-4">Buat Akun</h1>

    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block text-black mb-1">Nama</label>
            <input type="text" name="name" id="name"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <div>
            <label for="username" class="block text-black mb-1">Username</label>
            <input type="text" name="username" id="username"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <div>
            <label for="password" class="block text-black mb-1">Password</label>
            <input type="password" name="password" id="password"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
        </div>

        <div>
            <label for="role" class="block text-black mb-1">Role</label>
            <select name="role" id="role"
                class="w-full px-3 py-2 border border-black rounded-md focus:outline-none hover:border-gray-700 transition">
                <option value="">--Pilih Role--</option>
                @foreach($roles as $role)
                <option value="{{ $role }}">{{ $role }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit"
            class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition">
            Simpan
        </button>
        <a href="{{route('users.index')}}" class="inline-block px-4 py-2 border-2 border-gray-800 text-gray-900 font-semibold rounded-md 
          hover:bg-gray-100 transition">
            ← Kembali
        </a>
    </form>
</div>
@endsection