@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-md animate-fade-in-up flash-message">

    {{-- Logo & Header --}}
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-black rounded-full mb-4">
            <i class="fas fa-book text-white text-2xl"></i>
        </div>

        <h1 class="text-3xl font-bold text-white">Perpustakaan USK</h1>
        <p class="text-white mt-2">Sistem Manajemen Perpustakaan</p>
    </div>

    {{-- Login Form Card --}}
    <div class="bg-white rounded-xl p-8 border border-black">
        <h2 class="text-2xl font-bold text-black mb-6">Masuk ke Akun Anda</h2>

        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            {{-- Username Input --}}
            <div>
                <label for="username" class="block text-sm font-semibold text-black mb-2">
                    <i class="fas fa-user text-black mr-1"></i> Username
                </label>
                <input
                    class="w-full px-4 py-3 border border-black rounded-lg focus:outline-none focus:ring-0 focus:border-black transition
                    @error('username') border-black @enderror"
                    type="text"
                    name="username"
                    id="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    required
                    autofocus>

                @error('username')
                <p class="text-black text-sm mt-1 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                </p>
                @enderror

            </div>

            {{-- Password Input --}}
            <div>
                <label for="password" class="block text-sm font-semibold text-black mb-2">
                    <i class="fas fa-lock text-black mr-1"></i> Password
                </label>

                <div class="relative">
                    <input
                        class="w-full px-4 py-3 border border-black rounded-lg focus:outline-none focus:ring-0 focus:border-black transition
                        @error('password') border-black @enderror"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Masukkan password"
                        required>
                    <button
                        type="button"
                        class="absolute right-3 top-3 text-black hover:text-gray-700 transition"
                        onclick="togglePasswordVisibility()">
                        <i id="toggleIcon" class="fas fa-eye"></i>
                    </button>
                </div>

                @error('password')
                <p class="text-black text-sm mt-1 flex items-center">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                </p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full bg-black text-white font-bold py-3 px-4 rounded-lg hover:bg-gray-800 transition transform hover:scale-[1.02] flex items-center justify-center space-x-2 mt-6">
                <i class="fas fa-sign-in-alt"></i>
                <span>Masuk</span>
            </button>
            
                <a href="{{route('books.public')}}" class="inline-block px-4 py-2 border-2 border-gray-800 text-gray-900 font-semibold rounded-md 
                      hover:bg-gray-100 transition">
                    🏠 Kembali
                </a>
        </form>

        {{-- Error Message --}}
        @if($errors->any())
        <div class="mt-6 p-4 bg-white border border-black rounded-lg">
            <p class="text-black text-sm font-semibold flex items-center">
                <i class="fas fa-exclamation-triangle mr-2"></i> {{ $errors->first() }}
            </p>
        </div>
        @endif
    </div>

    {{-- Footer Info --}}
    <div class="text-center mt-6 text-sm text-white">
        <p><i class="fas fa-shield-alt text-white mr-1"></i> Koneksi aman dan terpercaya</p>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
@endsection