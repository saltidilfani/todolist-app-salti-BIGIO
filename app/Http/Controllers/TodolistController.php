<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todolist;

class TodolistController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');   
        $keyword = $request->query('q');       

        $todosQuery = Todolist::where('user_id', session('user_id'));

        if ($status === 'done') {
            $todosQuery->where('is_done', true);
        } elseif ($status === 'pending') {
            $todosQuery->where('is_done', false);
        }

        if ($keyword) {
            $todosQuery->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                      ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        $todos = $todosQuery
            ->orderByRaw('
                CASE 
                    WHEN is_done = 0 AND deadline IS NOT NULL THEN 0
                    WHEN is_done = 0 AND deadline IS NULL THEN 1
                    ELSE 2
                END
            ')
            ->orderBy('deadline', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('ToDoList.index', [
            'todos' => $todos,
            'statusFilter' => $status,
            'keyword' => $keyword,
        ]);
    }

    
    public function create()
    {
        return view('ToDoList.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'nullable|date',
        ]);

        Todolist::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'user_id' => session('user_id'),
        ]);

        return redirect('/todos')->with('success', 'To-Do berhasil ditambahkan!');
    }

    
    public function show($id)
    {
        $todo = Todolist::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('ToDoList.show', compact('todo'));
    }

    
    public function edit($id)
    {
        $todo = Todolist::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        return view('ToDoList.update', compact('todo'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'deadline' => 'nullable|date',
        ]);

        $todo = Todolist::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'is_done' => $request->has('is_done'),
        ]);

        return redirect('/todos')->with('success', 'To-Do berhasil diperbarui!');
    }

    
    public function destroy($id)
    {
        $todo = Todolist::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $todo->delete();

        return redirect('/todos')->with('success', 'To-Do berhasil dihapus!');
    }

    
    public function toggle($id)
    {
        $todo = Todolist::where('id', $id)
            ->where('user_id', session('user_id'))
            ->firstOrFail();

        $todo->update([
            'is_done' => !$todo->is_done,
        ]);

        return redirect('/todos')->with('success', 'Status tugas berhasil diubah!');
    }
}