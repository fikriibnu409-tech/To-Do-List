<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->get();
        return view('tasks', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
        ], [
            'title.required' => 'Judul tugas wajib diisi.',
            'title.min' => 'Judul tugas minimal harus 3 karakter.'
        ]);

        Task::create([
            'title' => $request->title,
            'status' => 0,
        ]);

        return redirect()->back()->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function updateStatus(Task $task)
    {
        $task->update([
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Status tugas diperbarui!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back()->with('success', 'Tugas berhasil dihapus!');
    }
}