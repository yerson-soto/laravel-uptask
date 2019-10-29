@extends('layouts.panel')

@section('main')
    lista de proyectos
    @foreach ($projects as $project)
        {{ $project->title }}
    @endforeach
@endsection
