<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','ToDoList App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#064e3b',
                        primaryLight: '#0f766e',
                        primarySoft: '#d1fae5',
                    },
                    boxShadow: {
                        glow: '0 20px 50px -20px rgba(6,78,59,0.55)',
                    },
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-primarySoft via-white to-primarySoft min-h-screen flex flex-col text-gray-900">

@php
    $isAuthPage = request()->routeIs('login', 'register');
@endphp

@if(!$isAuthPage)
    <nav class="bg-primary text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
            <a href="{{ session()->has('user_id') ? route('dashboard') : '/' }}" class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-white/10">
                    <svg class="w-5 h-5 text-primarySoft" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"></path>
                    </svg>
                </span>
                <span class="text-2xl font-extrabold tracking-tight">
                    To Do List App
                </span>
            </a>
            <div class="flex items-center gap-4 text-sm font-semibold">
                @if(session()->has('user_id'))
                    <span class="hidden sm:inline">Hi, {{ session('username') }}</span>
                    <a href="{{ route('logout') }}"
                       class="px-4 py-2 rounded-full bg-white/10 border border-white/30 hover:bg-white/20 transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 11-4 0v-1m0-8V7a2 2 0 114 0v1"></path>
                        </svg>
                        <span>Logout</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-primarySoft transition">Login</a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 rounded-full bg-white text-primary font-bold hover:bg-primarySoft hover:text-white transition">
                        Register
                    </a>
                @endif
            </div>
        </div>
    </nav>
@endif

<main class="flex-grow flex items-center justify-center px-4 py-10">
    @yield('content')
</main>

@if(!$isAuthPage)
    <footer class="py-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} To Do List App | Penugasan Magang di PT Bejana Investidata Globalindo | Salti Dilfani.
    </footer>
@endif

</body>
</html>