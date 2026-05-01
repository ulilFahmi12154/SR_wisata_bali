@extends('layouts.app')

@section('content')
<div class="flex">
    @include('components.admin.sidebar')

    <main class="flex-1 p-6">
        @yield('admin-content')
    </main>
</div>
@endsection