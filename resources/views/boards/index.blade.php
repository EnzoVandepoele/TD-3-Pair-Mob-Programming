@extends('layouts.app')

@section('content')
    <h1>Tableaux</h1>
    <a href="{{ route('boards.create') }}" class="btn btn-primary mb-3">Nouveau tableau</a>

    <div class="row">
        @foreach($boards as $board)
            <div class="col-md-4 mb-3">
                <div class="card p-3">
                    <h5><a href="{{ route('boards.show', $board) }}">{{ $board->name }}</a></h5>
                    <p>{{ $board->tasks_count }} tâches</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
