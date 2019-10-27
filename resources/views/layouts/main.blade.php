@extends('layouts.app')

@section('content')
    @include('partials.nav')

    <main class="py-4">
        @yield('main')
    </main>
@endsection
