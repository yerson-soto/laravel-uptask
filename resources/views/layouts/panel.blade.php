@extends('layouts.app')

@section('content')
    @include('partials.nav')

    @include('partials.aside')

    <main class="py-4">
        @yield('main')
    </main>
@endsection
