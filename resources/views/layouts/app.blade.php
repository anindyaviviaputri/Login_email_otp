<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'AninAuth') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="font-bold text-xl text-gray-800 hover:text-green-600 transition duration-300">
                            {{ config('app.name', 'AninAuth') }}
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @guest
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition duration-300">Register</a>
                            @endif
                        @else
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="flex items-center text-gray-600 hover:text-gray-900 transition duration-300">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down ml-2 text-sm"></i>
                                </button>
                                <!-- Dropdown menu -->
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-10" x-transition>
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content -->
        <main class="flex-grow">
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow-inner mt-10">
            <div class="max-w-7xl mx-auto px-4 py-4 text-center">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name', 'AninAuth') }}. All rights reserved.
                </p>
            </div>
        </footer>
    </div>
</body>
</html>