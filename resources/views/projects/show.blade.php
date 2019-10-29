@extends('layouts.panel')

@section('main')
    {{ $project->title }}
    <form action="{{ route('projects.destroy', $project) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">
            Eliminar
        </button>
    </form>
@endsection
