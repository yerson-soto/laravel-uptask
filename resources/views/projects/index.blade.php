@extends('layouts.panel')

@section('main')
    lista de proyectos
    @foreach ($projects as $project)
        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
    @endforeach


@endsection


