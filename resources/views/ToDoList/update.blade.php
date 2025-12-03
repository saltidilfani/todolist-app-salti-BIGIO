@extends('layouts.app')

@section('title', 'Update To-Do')

@section('content')
<div class="w-full max-w-lg bg-white/95 backdrop-blur rounded-3xl shadow-glow p-8 border border-primarySoft">
    <h2 class="text-2xl font-extrabold text-primary mb-6 text-center">Update To-Do</h2>

    <form action="{{ route('todos.update', $todo->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Judul</label>
            <input type="text" name="title" value="{{ $todo->title }}" required
                   class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm">
        </div>

        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Deskripsi</label>
            <textarea name="description" rows="4"
                      class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm">{{ $todo->description }}</textarea>
        </div>


        <div>
            <label class="block text-gray-700 mb-2 text-sm font-medium">Deadline</label>
            <input type="date" name="deadline"
                   value="{{ $todo->deadline ? $todo->deadline->format('Y-m-d') : '' }}"
                   class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-primaryLight border-gray-200 text-sm">
            <p class="text-gray-500 text-xs mt-1">Ubah tanggal batas waktu jika diperlukan.</p>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" id="is_done" name="is_done" {{ $todo->is_done ? 'checked' : '' }}
                   class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primaryLight">
            <label for="is_done" class="text-gray-700 text-sm">Tandai sebagai selesai</label>
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit"
                    class="flex-1 bg-primary text-white py-3 rounded-xl font-semibold hover:bg-primaryLight transition transform hover:-translate-y-0.5 hover:shadow-glow text-sm">
                Update
            </button>
            <a href="{{ route('todos.index') }}"
               class="flex-1 bg-gray-200 text-gray-700 py-3 rounded-xl font-semibold hover:bg-gray-300 transition text-center text-sm">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection