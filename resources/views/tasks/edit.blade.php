@extends('layouts.app')

@section('content')
    <h1>Modifier la tâche</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}">
            @error('title') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Tableau (optionnel)</label>
            <select name="board_id" class="form-select">
                <option value="">-- Aucun --</option>
                @foreach($boards as $board)
                    <option value="{{ $board->id }}" {{ $task->board_id == $board->id ? 'selected' : '' }}>{{ $board->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
