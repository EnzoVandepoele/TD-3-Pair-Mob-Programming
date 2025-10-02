<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest; // we'll create later
use App\Models\Task;
use App\Models\Board;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::orderBy('created_at', 'desc')->get();
        $boards = Board::all(); // pour le select si present
        return view('tasks.index', compact('tasks', 'boards'));
    }

    public function create(): View
    {
        $boards = Board::all();
        return view('tasks.create', compact('boards'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        Task::create($request->validated());
        return redirect()->route('tasks.index')->with('success', 'Tâche créée.');
    }

    public function complete(\App\Models\Task $task)
    {
        if (! $task->is_completed) {
            $task->update(['is_completed' => true]);
        }
        return back()->with('success', 'Tâche marquée comme terminée.');
    }
}
