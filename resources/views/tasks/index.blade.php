@extends('layouts.app')

@section('content')
    <h1>Liste des tâches</h1>

    {{-- Formulaire création rapide --}}
    <div class="card mb-3 p-3">
        <form action="{{ route('tasks.store') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-auto" style="flex:1;">
                <input type="text" name="title" class="form-control" placeholder="Titre de la tâche" value="{{ old('title') }}">
                @error('title') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="col-auto">
                <select name="board_id" class="form-select">
                    <option value="">-- Tableau (optionnel) --</option>
                    @foreach($boards as $board)
                        <option value="{{ $board->id }}">{{ $board->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-auto">
                <button class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>

    <ul class="list-group">
        @forelse($tasks as $task)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                @if($task->is_completed)
                    <del>{{ $task->title }}</del>
                    <span class="badge bg-success ms-2">terminée</span>
                @else
                    {{ $task->title }}
                @endif
                @if($task->board) <small class="text-muted">— {{ $task->board->name }}</small> @endif
                </div>

                <div class="btn-group" role="group" aria-label="actions">
                <!-- Les boutons compléter/modifier/supprimer seront ajoutés dans les exercices suivants -->
            </div>
        </li>
        @empty
        <li class="list-group-item">Aucune tâche pour le moment.</li>
        @endforelse
    </ul>
@endsection
