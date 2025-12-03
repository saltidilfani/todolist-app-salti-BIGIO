@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="w-full max-w-md">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-primary mb-2">Selamat Datang 👋</h1>
        <p class="text-gray-600 text-sm">Masuk untuk mulai mengatur tugas harianmu dengan rapi.</p>
    </div>

    <div class="bg-white/90 backdrop-blur rounded-3xl shadow-glow p-8 border border-primarySoft">
        <div class="flex items-center justify-center mb-6">
            <div class="w-14 h-14 rounded-2xl bg-primarySoft flex items-center justify-center">
                <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 1116 0H4z"></path>
                </svg>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 mb-2 text-sm font-medium">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </span>
                    <input type="text" name="username" required
                           class="w-full pl-9 pr-3 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                           placeholder="Masukkan username">
                </div>
            </div>

            <div>
                <label class="block text-gray-700 mb-2 text-sm font-medium">Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 10-6 0v2c0 1.657 1.343 3 3 3z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 11h14v8a2 2 0 01-2 2H7a2 2 0 01-2-2v-8z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" required
                           class="w-full pl-9 pr-3 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                           placeholder="Masukkan password">
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primaryLight transition transform hover:-translate-y-0.5 hover:shadow-glow text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 12h14M12 5l7 7-7 7"/>
                </svg>
                <span>Masuk</span>
            </button>
        </form>

        <p class="mt-4 text-center text-gray-600 text-sm">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>
</div>
@endsection