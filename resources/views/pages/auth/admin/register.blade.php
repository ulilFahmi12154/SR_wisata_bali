@extends('layouts.app')

@section('title', 'Admin Registration — Jelajah Bali')

@push('styles')
<style>
    .admin-bg {
        background:
            linear-gradient(rgba(241,245,249,.88), rgba(241,245,249,.88)),
            url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80');
        background-size: cover;
        background-position: center;
    }

    .card-clean {
        background: #fff;
        box-shadow:
            0 10px 25px -5px rgba(0,0,0,.05),
            0 8px 10px -6px rgba(0,0,0,.05);
    }

    .input-custom {
        background-color: #f1f5f9;
        border: 1px solid transparent;
        color: #1e293b;
    }

    .input-custom::placeholder {
        color: #94a3b8;
    }

    .input-custom:focus {
        outline: none;
        background-color: #fff;
        border-color: #0284c7;
        box-shadow: 0 0 0 2px rgba(2,132,199,.15);
    }

    .input-error {
        border-color: #ef4444 !important;
        background-color: #fef2f2;
    }
</style>
@endpush

@section('body')

<div class="min-h-screen admin-bg flex flex-col justify-between p-6 font-sans text-slate-700">

    {{-- Header --}}
    <header class="w-full max-w-7xl mx-auto flex items-center justify-between px-4 py-2">
        <div class="text-sky-800 font-bold text-lg tracking-tight">
            Admin Jelajah
        </div>

        <nav class="flex items-center gap-6 text-sm font-medium text-slate-600">
            <a href="#" class="hover:text-sky-700 transition-colors">Help</a>
            <a href="#" class="hover:text-sky-700 transition-colors">Privacy</a>
            <a href="#" class="hover:text-sky-700 transition-colors">Support</a>
        </nav>
    </header>

    {{-- Main --}}
    <main class="flex-1 flex flex-col items-center justify-center py-12">

        <div class="w-full max-w-md card-clean rounded-2xl overflow-hidden">

            <div class="p-10">

                {{-- Heading --}}
                <div class="text-center mb-6">
                    <span class="text-[10px] font-bold tracking-widest text-sky-700 uppercase bg-sky-50 px-2.5 py-1 rounded-md">
                        Administrative Access
                    </span>

                    <h1 class="text-2xl font-bold text-slate-800 mt-2 tracking-tight">
                        Create Admin Account
                    </h1>

                    <p class="text-slate-500 text-xs mt-2 max-w-xs mx-auto leading-relaxed">
                        Join the administrative team managing premium travel experiences.
                    </p>
                </div>

                {{-- Success --}}
                @if(session('success'))
                    <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3">
                        <p class="text-xs font-medium text-green-700">
                            {{ session('success') }}
                        </p>
                    </div>
                @endif

                {{-- Error --}}
                @if(session('error'))
                    <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3">
                        <p class="text-xs font-medium text-red-700">
                            {{ session('error') }}
                        </p>
                    </div>
                @endif

                {{-- Form --}}
                <form
                    action="{{ route('admin.register.process') }}"
                    method="POST"
                    class="space-y-4"
                    x-data="{
                        loading: false,
                        showPassword: false,
                        showConfirmPassword: false
                    }"
                    @submit="loading = true"
                >
                    @csrf

                    {{-- Full Name --}}
                    <div class="space-y-1.5">
                        <label for="name"
                               class="block text-xs font-semibold text-slate-700 tracking-wide">
                            Full Name
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                          d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                placeholder="Alexander Thorne"
                                required
                                class="input-custom w-full rounded-xl pl-10 pr-4 py-3 text-sm transition-all duration-150 @error('name') input-error @enderror"
                            >
                        </div>

                        @error('name')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="space-y-1.5">
                        <label for="email"
                               class="block text-xs font-semibold text-slate-700 tracking-wide">
                            Email Address
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75"
                                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8"/>
                                </svg>
                            </div>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                placeholder="admin@jelajahbali.com"
                                required
                                class="input-custom w-full rounded-xl pl-10 pr-4 py-3 text-sm transition-all duration-150 @error('email') input-error @enderror"
                            >
                        </div>

                        @error('email')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Admin Secret Key --}}
                    <div class="space-y-1.5">
                        <label for="admin_key"
                               class="block text-xs font-semibold text-slate-700 tracking-wide">
                            Admin Secret Key
                        </label>

                        <input
                            type="password"
                            id="admin_key"
                            name="admin_key"
                            placeholder="Enter secret access key"
                            required
                            class="input-custom w-full rounded-xl px-4 py-3 text-sm transition-all duration-150 @error('admin_key') input-error @enderror"
                        >

                        @error('admin_key')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Password --}}
                        <div class="space-y-1.5">

                            <label for="password"
                                   class="block text-xs font-semibold text-slate-700 tracking-wide">
                                Password
                            </label>

                            <div class="relative">

                                <input
                                    :type="showPassword ? 'text' : 'password'"
                                    id="password"
                                    name="password"
                                    autocomplete="new-password"
                                    placeholder="••••••••"
                                    required
                                    class="input-custom w-full rounded-xl px-4 py-3 pr-11 text-sm transition-all duration-150 @error('password') input-error @enderror"
                                >

                                <button
                                    type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600"
                                >
                                    👁
                                </button>

                            </div>

                            @error('password')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror

                        </div>

                        {{-- Confirm --}}
                        <div class="space-y-1.5">

                            <label for="password_confirmation"
                                   class="block text-xs font-semibold text-slate-700 tracking-wide">
                                Confirm Password
                            </label>

                            <div class="relative">

                                <input
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    autocomplete="new-password"
                                    placeholder="••••••••"
                                    required
                                    class="input-custom w-full rounded-xl px-4 py-3 pr-11 text-sm transition-all duration-150"
                                >

                                <button
                                    type="button"
                                    @click="showConfirmPassword = !showConfirmPassword"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600"
                                >
                                    👁
                                </button>

                            </div>

                        </div>

                    </div>

                    {{-- Terms --}}
                    <div class="flex items-start pt-1">

                        <div class="flex items-center h-5">
                            <input
                                id="terms"
                                name="terms"
                                type="checkbox"
                                required
                                class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500"
                            >
                        </div>

                        <div class="ml-2 text-xs">
                            <label for="terms" class="text-slate-500 font-medium">
                                I agree to the
                                <a href="#"
                                   class="text-sky-700 hover:underline font-bold">
                                    terms and conditions
                                </a>
                            </label>
                        </div>

                    </div>

                    @error('terms')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror

                    {{-- Submit --}}
                    <div class="pt-2">

                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full flex items-center justify-center gap-2
                                   bg-[#006699] hover:bg-sky-700 active:bg-sky-800
                                   text-white font-semibold text-sm rounded-full py-3.5
                                   transition-all duration-150 shadow-md"
                        >

                            <span x-show="!loading">
                                Create Admin Account
                            </span>

                            <span x-show="loading" style="display:none">
                                Creating Account...
                            </span>

                        </button>

                    </div>

                </form>

            </div>

            {{-- Footer --}}
            <div class="bg-slate-50 border-t border-slate-100 py-4 text-center text-xs font-medium">

                <span class="text-slate-500">
                    Already have an account?
                </span>

                <a href="{{ route('admin.login') }}"
                   class="text-sky-700 hover:text-sky-800 font-bold ml-1">
                    Sign In
                </a>

            </div>

        </div>

    </main>

    {{-- Footer --}}
    <footer class="w-full max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between border-t border-slate-300/40 pt-4 text-xs text-slate-500 gap-2 px-4">

        <div>
            © {{ date('Y') }} Kelompok 3.
        </div>

        <div class="flex items-center gap-5">
            <a href="#" class="hover:text-slate-700">Terms</a>
            <a href="#" class="hover:text-slate-700">Privacy</a>
            <a href="#" class="hover:text-slate-700">Support</a>
        </div>

    </footer>

</div>

@endsection