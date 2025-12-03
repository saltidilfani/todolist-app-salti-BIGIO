@extends('layouts.app')

@section('title', 'Tambah To-Do')

@section('content')
<div class="w-full max-w-md bg-white/95 backdrop-blur rounded-3xl shadow-glow p-8 border border-primarySoft">
    <h2 class="text-2xl font-extrabold text-primary text-center mb-6">Tambah To-Do</h2>

    <form action="{{ route('todos.store') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Judul</label>
            <input type="text" name="title" required
                   class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                   placeholder="Contoh: Belajar Laravel, Meeting, dll">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Deskripsi (Opsional)</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm"
                      placeholder="Tambahkan detail tambahan jika perlu..."></textarea>
        </div>

        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Deadline (Opsional)</label>
            <input type="date" name="deadline"
                   class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm">
            <p class="text-gray-500 text-xs mt-1">Pilih tanggal batas waktu tugas ini.</p>
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="flex-1 bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primaryLight transition transform hover:-translate-y-0.5 hover:shadow-glow text-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>
                <span>Simpan</span>
            </button>
            <a href="{{ route('todos.index') }}"
               class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition text-center text-sm">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection