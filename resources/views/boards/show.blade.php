@extends('layouts.app')

@section('content')
    <h1>Tableau: {{ $board->name }}</h1>

    <a href="{{ route('tasks.create') }}" class="btn btn-sm btn-primary mb-3">Ajouter tâche</a>

    <table class="table">
        <thead>
            <tr><th>Titre</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($board->tasks as $task)
                <tr>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->is_completed ? 'Terminée' : 'Ouverte' }}</td>
                    <td>
                        <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline">
                            @csrf @method('PATCH')
                            <button class="btn btn-success btn-sm" {{ $task->is_completed ? 'disabled' : '' }}>Terminer</button>
                        </form>
                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary btn-sm">Modifier</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
