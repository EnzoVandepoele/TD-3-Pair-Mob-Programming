<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::withCount('tasks')->get();
        return view('boards.index', compact('boards'));
    }

    public function create()
    {
        return view('boards.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name'=>'required|max:255']);
        Board::create($request->only('name'));
        return redirect()->route('boards.index')->with('success', 'Tableau créé.');
    }

    public function show(Board $board)
    {
        $board->load('tasks');
        return view('boards.show', compact('board'));
    }

    public function edit(Board $board)
    {
        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, Board $board)
    {
        $request->validate(['name'=>'required|max:255']);
        $board->update($request->only('name'));
        return redirect()->route('boards.index')->with('success', 'Tableau modifié.');
    }

    public function destroy(Board $board)
    {
        $board->delete();
        return redirect()->route('boards.index')->with('success', 'Tableau supprimé.');
    }
}
