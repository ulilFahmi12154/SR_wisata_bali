@extends('layouts.app')

@section('content')
<style>
    :root {
        --color-primary: #2E86C1;
        --color-accent: #E8A537;
        --font-body: 'DM Sans', sans-serif;
    }
</style>

<div class="flex h-screen">
    @include('components.admin.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        @include('components.admin.topbar')

        <main class="flex-1 overflow-y-auto p-6 bg-slate-50">
            @yield('admin-content')
        </main>
    </div>
</div>
@endsection