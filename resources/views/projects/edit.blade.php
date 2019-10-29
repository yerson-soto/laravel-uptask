@extends('layouts.panel')

@section('main')
    <div>
        <h2>@lang('Edit project')</h2>
        {{-- Include the create project form --}}
        <form action="{{ route('projects.update', $project) }}" method="POST">
            @method('PUT')
            @include('projects._form', [
                'project' => $project,
                'btnName' => 'Update'
            ])
        </form>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>

@endsection
