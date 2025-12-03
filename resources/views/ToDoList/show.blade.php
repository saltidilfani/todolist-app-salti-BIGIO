@extends('layouts.app')

@section('title', 'Detail To-Do')

@section('content')
<div class="w-full max-w-3xl bg-white/95 backdrop-blur rounded-3xl shadow-glow px-6 md:px-10 py-10 border border-primarySoft">
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-sm text-primaryLight font-semibold mb-1">Detail To-Do</p>
            <h2 class="text-3xl font-extrabold text-primary">{{ $todo->title }}</h2>
        </div>
        <div class="w-14 h-14 rounded-2xl bg-primarySoft flex items-center justify-center">
            <svg class="w-7 h-7 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m2-2a2 2 0 012 2v9a2 2 0 01-2 2H7
                       a2 2 0 01-2-2V7a2 2 0 012-2h5l2 2h3z"/>
            </svg>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6 text-sm text-gray-700">
        <div class="p-4 border border-primarySoft rounded-2xl">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Status</p>
            @if($todo->is_done)
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                    Selesai
                </span>
            @else
                <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3"/>
                    </svg>
                    Belum Selesai
                </span>
            @endif
        </div>

        <div class="p-4 border border-primarySoft rounded-2xl">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Dibuat pada</p>
            <p class="text-base font-semibold">{{ $todo->created_at->format('d M Y') }}</p>
            <p class="text-xs text-gray-500">Pukul {{ $todo->created_at->format('H:i') }} WIB</p>
        </div>

        <div class="p-4 border border-primarySoft rounded-2xl md:col-span-2">
            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Deadline</p>
            @if($todo->deadline)
                @php
                    $daysLeft = now()->startOfDay()->diffInDays($todo->deadline, false);
                @endphp
                <div class="flex items-center gap-2">
                    <p class="text-base font-semibold">{{ $todo->deadline->format('d M Y') }}</p>
                    @if($daysLeft < 0)
                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">
                            Lewat deadline
                        </span>
                    @elseif($daysLeft === 0)
                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700 text-xs font-semibold">
                            Deadline hari ini
                        </span>
                    @elseif($daysLeft <= 2)
                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">
                            {{ $daysLeft }} hari lagi
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full bg-primarySoft text-primary text-xs font-semibold">
                            {{ $daysLeft }} hari tersisa
                        </span>
                    @endif
                </div>
            @else
                <p class="text-base font-semibold text-gray-500">Belum diatur</p>
            @endif
        </div>
    </div>

    <div class="mb-8">
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">Deskripsi</p>
        <div class="p-4 border border-primarySoft rounded-2xl text-sm text-gray-700 leading-relaxed">
            {{ $todo->description ?: 'Tidak ada deskripsi.' }}
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-3">
        <a href="{{ route('todos.edit', $todo->id) }}"
           class="flex-1 bg-primary text-white py-3 rounded-xl text-center font-semibold hover:bg-primaryLight transition text-sm flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M11 5H7a2 2 0 00-2 2v11
                       a2 2 0 002 2h10a2 2 0 002-2V9
                       a2 2 0 00-.586-1.414l-4-4
                       A2 2 0 0013 3H7z"/>
            </svg>
            <span>Edit Tugas</span>
        </a>
        <a href="{{ route('todos.index') }}"
           class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl text-center font-semibold hover:bg-gray-300 transition text-sm">
            Kembali ke Daftar
        </a>
    </div>
</div>
@endsection