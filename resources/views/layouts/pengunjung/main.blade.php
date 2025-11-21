<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} | @yield('title')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f2f2f2;
        }

        ::-webkit-scrollbar-thumb {
            background: #bcbcbc;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #999;
        }

        * {
            transition: colors 0.2s, background-color 0.2s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }
    </style>
</head>



<body class="bg-white text-gray-900">

    {{-- Navbar Hitam Putih --}}
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                {{-- Logo --}}
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 border border-gray-700 rounded-md flex items-center justify-center">
                        <i class="fas fa-book text-gray-700 text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-900">{{ config('app.name', 'Perpustakaan') }}</span>
                </div>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('books.list') }}"
                        class="px-4 py-2 font-medium text-gray-800 border border-gray-700 rounded hover:bg-gray-100
                        flex items-center space-x-2">
                        <i class="fas fa-home text-base"></i>
                        <span>Beranda</span>
                    </a>

                    <a href="#" id="btnRiwayat"
                        class="px-4 py-2 font-medium text-gray-800 border border-gray-700 rounded hover:bg-gray-100
                        flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span>Riwayat Transaksi</span>
                    </a>

                </div>

                {{-- User --}}
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="hidden sm:flex items-center space-x-3">
                            <i class="fas fa-user-circle text-gray-600"></i>
                            <div>
                                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-600">{{ ucfirst(Auth::user()->role) }}</p>
                            </div>
                        </div>

                        {{-- Tombol Logout (tetap merah) --}}
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg font-medium hover:bg-red-700">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </button>
                        </form>
                    @else
                        {{-- Tombol Login (tetap biru) --}}
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>


    @if ($message = Session::get('success'))
        <div class="fixed top-20 right-4 z-50">
            <div class="bg-white border border-gray-700 p-4 rounded-lg shadow-lg flex items-start space-x-3">
                <i class="fas fa-check-circle text-gray-800"></i>
                <div>
                    <p class="font-semibold text-gray-900">Berhasil</p>
                    <p class="text-sm text-gray-700">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="fixed top-20 right-4 z-50 ">
            <div class="bg-white border border-gray-700 p-4 rounded-lg shadow-lg flex items-start space-x-3">
                <i class="fas fa-exclamation-circle text-gray-800"></i>
                <div>
                    <p class="font-semibold text-gray-900">Kesalahan</p>
                    <p class="text-sm text-gray-700">{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed top-20 right-4 z-50">
            <div class="bg-white border border-gray-700 p-4 rounded-lg shadow-lg">
                <p class="font-semibold text-gray-900 mb-2">Ada kesalahan:</p>
                <ul class="text-sm text-gray-700 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
        {{-- Modal --}}
        <div id="modalWarning" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">
            <div class="relative bg-white p-6 rounded shadow w-80 text-center">
    
                <!-- Tombol Close -->
                <button id="modalBtnClose" class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 text-xl">
                    &times;
                </button>
    
                <p id="modalMessage" class="mb-4 text-gray-800"></p>
                <a id="modalButton" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Login
                </a>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-300 text-gray-700 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>


    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <script>
            window.APP = {
                user: {
                    checkLogin: @json(Auth::check()),
                    role: @json(optional(Auth::user())->role),
                },
                routes:{
                    riwayatUrl: @json(route('pengunjung.list')),
                    requestUrl: @json(route('requests.create', ['book' => 'BOOK_ID'])),
                    loginUrl: @json(route('login')),
                }
            };
        </script>

        <script>
            function showModal(message, link = '#') {
                document.getElementById('modalMessage').innerText = message;
                document.getElementById('modalButton').href = link;
                document.getElementById('modalWarning').classList.remove('hidden');
            };


            document.getElementById('modalBtnClose').addEventListener('click', function() {
                document.getElementById('modalWarning').classList.add('hidden');
            });

            document.getElementById('btnRiwayat').addEventListener('click', function(e) {
                e.preventDefault();

                if (!APP.user.checkLogin) {
                    return showModal('Anda harus login dulu', APP.routes.loginUrl);
                    
                };

                if (APP.user.role !== 'pengunjung') {
                    return showModal('Akses khusus pengunjung', APP.routes.loginUrl);
                
                };


                window.location.href = APP.routes.riwayatUrl;
            });
        </script>

        @yield('scripts')

</body>


</html>
