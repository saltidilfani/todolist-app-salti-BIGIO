@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="w-full max-w-4xl">
    <div class="bg-white/90 backdrop-blur rounded-3xl shadow-glow p-8 mb-6 border border-primarySoft">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <p class="text-sm font-medium text-primaryLight mb-1">Halo, {{ session('username') }}</p>
                <h1 class="text-3xl md:text-4xl font-extrabold text-primary mb-2">
                    Atur tugasmu dengan tenang 🌿
                </h1>
                <p class="text-gray-600">
                    Buat, tandai selesai, dan hapus tugas dengan tampilan yang bersih dan nyaman dilihat.
                </p>
            </div>
            <div class="relative">
                <div class="w-28 h-28 rounded-3xl bg-primarySoft flex items-center justify-center">
                    <svg class="w-14 h-14 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m2-2a2 2 0 012 2v9a2 2 0 01-2 2H7
                               a2 2 0 01-2-2V7a2 2 0 012-2h5l2 2h3z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('todos.index') }}"
           class="group bg-primary text-white rounded-3xl shadow-lg p-6 flex items-center justify-between hover:bg-primaryLight transition transform hover:-translate-y-1 hover:shadow-glow">
            <div>
                <h3 class="text-xl font-bold mb-1">Lihat Todo List</h3>
                <p class="text-sm text-primarySoft/90">Kelola semua tugasmu di satu tempat.</p>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primarySoft" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5h10M9 9h10M9 13h6M5 7h.01M5 11h.01M5 15h.01"/>
                    </svg>
                </div>
                <svg class="w-6 h-6 text-primarySoft group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        </a>

        <a href="{{ route('todos.create') }}"
           class="group bg-white rounded-3xl shadow-lg p-6 border border-primarySoft hover:border-primary transition transform hover:-translate-y-1 hover:shadow-glow flex items-center justify-between">
            <div>
                <h3 class="text-xl font-bold text-primary mb-1">Tambah Tugas Baru</h3>
                <p class="text-sm text-gray-600">Catat hal penting sebelum terlupa.</p>
            </div>
            <div class="w-10 h-10 rounded-2xl bg-primarySoft flex items-center justify-center group-hover:scale-110 transition">
                <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
            </div>
        </a>
    </div>
</div>
@endsection