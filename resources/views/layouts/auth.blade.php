<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome for Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Prevent scrolling */
        html,
        body {
            overflow: hidden;
            height: 100%;
            width: 100%;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-neutral-950 via-zinc to-zinc-400 flex items-center justify-center">
    {{-- Flash Messages --}}
    @if ($message = Session::get('success'))
    <div class="fixed top-6 right-4 z-50">
        <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-lg flex items-start space-x-3">
            <i class="fas fa-check-circle text-green-600 mt-1"></i>
            <div>
                <p class="font-semibold text-green-900">Berhasil</p>
                <p class="text-sm text-green-700">{{ $message }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-600 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="fixed top-6 right-4 z-50">
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg flex items-start space-x-3">
            <i class="fas fa-exclamation-circle text-red-600 mt-1"></i>
            <div>
                <p class="font-semibold text-red-900">Kesalahan</p>
                <p class="text-sm text-red-700">{{ $message }}</p>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-600 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    @endif


    {{-- Main Content --}}
    <main class="w-full h-full flex items-center justify-center p-4">
        @yield('content')
    </main>

    {{-- Alpine.js untuk interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>