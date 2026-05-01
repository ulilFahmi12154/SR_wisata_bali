@extends('layouts.app')

@section('body')

    <x-user.navbar />

    <main class="min-h-screen px-4 md:px-8 py-6">
        @yield('content')
    </main>

    <x-user.footer />

@endsection