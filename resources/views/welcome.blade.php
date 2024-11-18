@extends('layouts.app')

@section('content')
<div class="relative min-h-screen bg-green-50">
    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side -->
            <div class="space-y-8">
                <h1 class="text-4xl font-bold text-green-800 sm:text-5xl">
                    Secure Authentication System
                </h1>
                <p class="text-lg text-green-600">
                    Sistem otentikasi dua faktor yang aman dengan verifikasi email untuk melindungi akun Anda.
                </p>
                <div class="flex space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                                Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" 
                                   class="inline-flex items-center px-6 py-3 border border-green-300 text-green-700 rounded-lg hover:bg-green-100 transition duration-300">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Right Side - Features -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-green-100">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">Keamanan Tinggi</h3>
                    <p class="mt-2 text-green-600">Dilengkapi dengan sistem otentikasi dua faktor</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-green-100">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">Email Verifikasi</h3>
                    <p class="mt-2 text-green-600">Verifikasi melalui email untuk keamanan tambahan</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-green-100">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">Privasi Terjamin</h3>
                    <p class="mt-2 text-green-600">Data pengguna dilindungi dengan enkripsi</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-green-100">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-green-800">Akses 24/7</h3>
                    <p class="mt-2 text-green-600">Sistem tersedia setiap saat</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection