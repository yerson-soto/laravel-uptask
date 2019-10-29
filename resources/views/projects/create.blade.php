@extends('layouts.panel')

@section('main')
    <div>
        <h2>@lang('New project')</h2>
        {{-- Include the create project form --}}
        <form action="{{ route('projects.store') }}" method="POST">
            @include('projects._form', ['btnName' => 'Add'])
        </form>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
    </div>

@endsection
