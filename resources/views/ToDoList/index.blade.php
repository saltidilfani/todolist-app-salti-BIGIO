@extends('layouts.app')

@section('title', 'My To-Do List')

@section('content')
<div class="w-full bg-white/95 backdrop-blur rounded-3xl shadow-glow px-4 md:px-8 py-8 border border-primarySoft">
    
    <div class="flex flex-col gap-4 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold text-primary">Daftar Tugasmu</h2>
                <p class="text-gray-600 text-sm">Pantau semua tugas, yang sudah dan belum selesai.</p>
            </div>
        </div>

        @php
            $total = $todos->count();
            $done = $todos->where('is_done', true)->count();
            $pending = $todos->where('is_done', false)->count();
        @endphp

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
            
            <div class="bg-blue-50 border border-blue-200 rounded-2xl px-4 py-3 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5h10M9 9h10M9 13h6M5 7h.01M5 11h.01M5 15h.01"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total Tugas</p>
                    <p class="text-lg font-bold text-blue-700">{{ $total }}</p>
                </div>
            </div>

            
            <div class="bg-green-50 border border-green-200 rounded-2xl px-4 py-3 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Selesai</p>
                    <p class="text-lg font-bold text-green-700">{{ $done }}</p>
                </div>
            </div>

        
            <div class="bg-yellow-50 border border-yellow-200 rounded-2xl px-4 py-3 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-yellow-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Belum Selesai</p>
                    <p class="text-lg font-bold text-yellow-700">{{ $pending }}</p>
                </div>
            </div>
        </div>
    </div>

    
    @php $statusFilter = $statusFilter ?? null; $keyword = $keyword ?? null; @endphp
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-8 text-sm">
        <div class="flex flex-wrap items-center gap-2">
            <span class="text-gray-500">Tampilkan:</span>
            <a href="{{ route('todos.index', array_filter(['status' => null, 'q' => $keyword])) }}"
               class="px-3 py-1 rounded-full border {{ $statusFilter === null ? 'bg-primary text-white border-primary' : 'border-gray-300 text-gray-600 hover:border-primary hover:text-primary' }}">
                Semua
            </a>
            <a href="{{ route('todos.index', array_filter(['status' => 'pending', 'q' => $keyword])) }}"
               class="px-3 py-1 rounded-full border {{ $statusFilter === 'pending' ? 'bg-yellow-500 text-white border-yellow-500' : 'border-gray-300 text-gray-600 hover:border-yellow-500 hover:text-yellow-600' }}">
                Belum Selesai
            </a>
            <a href="{{ route('todos.index', array_filter(['status' => 'done', 'q' => $keyword])) }}"
               class="px-3 py-1 rounded-full border {{ $statusFilter === 'done' ? 'bg-green-600 text-white border-green-600' : 'border-gray-300 text-gray-600 hover:border-green-500 hover:text-green-600' }}">
                Sudah Selesai
            </a>
        </div>

        <form action="{{ route('todos.index') }}" method="GET" class="flex flex-col md:flex-row gap-2">
            @if($statusFilter)
                <input type="hidden" name="status" value="{{ $statusFilter }}">
            @endif
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 6a4 4 0 100 8 4 4 0 000-8zm6 10l-2.5-2.5"/>
                    </svg>
                </span>
                <input type="text" name="q" value="{{ $keyword }}"
                       class="pl-9 pr-3 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                       placeholder="Cari judul atau deskripsi...">
            </div>
            <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-xl hover:bg-primaryLight transition text-sm">
                Cari
            </button>
        </form>
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

    
    <form action="{{ route('todos.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex flex-col md:flex-row gap-2">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5h10M9 9h10M9 13h6M5 7h.01M5 11h.01M5 15h.01"/>
                    </svg>
                </span>
                <input type="text" name="title"
                       class="w-full pl-9 pr-3 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                       placeholder="Tulis tugas baru di sini..." required>
            </div>
            <button type="submit"
                    class="px-5 py-3 bg-primary text-white rounded-xl font-semibold hover:bg-primaryLight transition transform hover:-translate-y-0.5 hover:shadow-glow text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                <span>Tambah</span>
            </button>
        </div>
    </form>

    
    @if($todos->count() > 0)
        <ul class="space-y-3">
            @foreach($todos as $todo)
                <li class="flex items-start gap-3 p-4 bg-gray-50 rounded-xl hover:bg-primarySoft/40 transition">
                    
                    <form action="{{ route('todos.toggle', $todo->id) }}" method="POST" class="flex-shrink-0 mt-1">
                        @csrf
                        <button type="submit"
                                class="w-8 h-8 flex items-center justify-center rounded-full border-2 {{ $todo->is_done ? 'border-green-500 bg-green-50' : 'border-primarySoft bg-white hover:border-primaryLight' }} transition transform hover:scale-110"
                                title="Tandai selesai / belum">
                            @if($todo->is_done)
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            @else
                                <svg class="w-4 h-4 text-primaryLight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 4v16m8-8H4"/>
                                </svg>
                            @endif
                        </button>
                    </form>

                    
                    <div class="flex-1">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-gray-800 text-sm font-semibold {{ $todo->is_done ? 'line-through text-gray-500' : '' }}">
                                {{ $todo->title }}
                            </span>
                        </div>

                        <div class="flex flex-wrap items-center gap-2 mt-2 text-xs text-gray-500">
                            <span>Dibuat: {{ $todo->created_at->format('d M Y') }}</span>

                            @if($todo->deadline)
                                @php
                                    $daysLeft = now()->startOfDay()->diffInDays($todo->deadline, false);
                                @endphp
                                <span>
                                    Deadline: {{ $todo->deadline->format('d M Y') }}
                                </span>

                                @if($daysLeft < 0)
                                    <span class="px-2 py-0.5 rounded-full bg-red-100 text-red-700 font-semibold">
                                        Lewat deadline
                                    </span>
                                @elseif($daysLeft === 0)
                                    <span class="px-2 py-0.5 rounded-full bg-orange-100 text-orange-700 font-semibold">
                                        Deadline hari ini
                                    </span>
                                @elseif($daysLeft <= 2)
                                    <span class="px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 font-semibold">
                                        {{ $daysLeft }} hari lagi
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>

                
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <a href="{{ route('todos.show', $todo->id) }}"
                           class="p-2 rounded-lg hover:bg-primarySoft/60 text-primaryLight transition"
                           title="Lihat detail">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M2.458 12C3.732 7.943 7.523 5 12 5
                                       c4.478 0 8.268 2.943 9.542 7
                                       -1.274 4.057-5.064 7-9.542 7
                                       -4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </a>

                        <a href="{{ route('todos.edit', $todo->id) }}"
                           class="p-2 rounded-lg hover:bg-primarySoft/60 text-primaryLight transition"
                           title="Edit tugas">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H7a2 2 0 00-2 2v11
                                       a2 2 0 002 2h10a2 2 0 002-2v-5
                                       m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9
                                       v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>

                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" class="flex-shrink-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-xs flex items-center gap-1"
                                    title="Hapus"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862
                                           a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6
                                           m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3
                                           M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center py-10 text-gray-500">
            <p class="text-sm mb-3">Belum ada tugas tercatat.</p>
            <p class="text-xs">Mulai dengan menambahkan tugas pertama di atas 🌱</p>
        </div>
    @endif
</div>
@endsection