@extends('layouts.app')

@section('title', 'Admin Portal — Jelajah Bali')

@push('styles')
<style>
    /* Background menggunakan gambar alam/sawah Bali transparan ber-layer */
    .admin-bg {
        background: linear-gradient(rgba(241, 245, 249, 0.85), rgba(241, 245, 249, 0.85)), 
                    url('https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80');
        background-size: cover;
        background-position: center;
    }
    /* Card putih bersih dengan efek shadow lembut */
    .card-clean {
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
    }
    /* Input field abu-abu terang sesuai gambar mock-up */
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
        background-color: #ffffff;
        border-color: #0284c7;
        box-shadow: 0 0 0 2px rgba(2, 132, 199, 0.15);
    }
</style>
@endpush

@section('body')
<div class="min-h-screen admin-bg flex flex-col justify-between p-6 font-sans text-slate-700">
    
    {{-- Navbar Atas (Header-style sesuai gambar) --}}
    <header class="w-full max-w-7xl mx-auto flex items-center justify-between px-4 py-2">
        <div class="text-sky-800 font-bold text-lg tracking-tight">Admin Jelajah</div>
        <nav class="flex items-center gap-6 text-sm font-medium text-slate-600">
            <a href="{{ route('admin.help') }}" class="hover:text-sky-700 transition-colors">Help</a>
            <a href="{{ route('privacy.policy') }}" class="hover:text-sky-700 transition-colors">Privacy</a>
            <a href="{{ route('admin.support') }}" class="hover:text-sky-700 transition-colors">Support</a>
        </nav>
    </header>

    {{-- Main Content / Card Container --}}
    <main class="flex-1 flex flex-col items-center justify-center py-12">
        <div class="w-full max-w-md card-clean rounded-2xl overflow-hidden">
            
            {{-- Bagian Form Utama --}}
            <div class="p-10">
                {{-- Badge + Judul Atas --}}
                <div class="text-center mb-6">
                    <span class="text-[10px] font-bold tracking-widest text-emerald-700 uppercase bg-emerald-50 px-2.5 py-1 rounded-md">
                        Secure Access
                    </span>
                    <h1 class="text-2xl font-bold text-slate-800 mt-2 tracking-tight">Admin Portal</h1>
                    <p class="text-slate-500 text-xs mt-2 max-w-xs mx-auto leading-relaxed">
                        Enter your credentials to manage the Horizon ecosystem.
                    </p>
                </div>

                {{-- Alert Error jika gagal login --}}
                @if (session('error') || $errors->any())
                    <div class="mb-5 flex items-center gap-2 rounded-xl bg-red-50 border border-red-200 px-4 py-3">
                        <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-red-600 text-xs font-medium">
                            {{ session('error') ?? $errors->first() }}
                        </p>
                    </div>
                @endif

                {{-- Form Login -> PERBAIKAN: Diarahkan ke rute .login.process --}}
                <form action="{{ route('admin.login.process') }}" method="POST" class="space-y-5"
                      x-data="{ loading: false, showPass: false }" @submit="loading = true">
                    @csrf

                    {{-- Input Email --}}
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-semibold text-slate-700 tracking-wide">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="admin@jelajah.com"
                                autocomplete="email"
                                required
                                data-label="Email administrator"
                                oninvalid="const label = this.getAttribute('data-label') || 'Email administrator'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } else if (this.validity.typeMismatch) { message = 'Format ' + label.toLowerCase() + ' tidak valid.'; } this.setCustomValidity(message);"
                                oninput="this.setCustomValidity('');"
                                class="input-custom w-full rounded-xl pl-10 pr-4 py-3 text-sm transition-all duration-150"
                            >
                        </div>
                    </div>

                    {{-- Input Password --}}
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-xs font-semibold text-slate-700 tracking-wide">
                                Password
                            </label>
                            <a href="{{ route('admin.password.request') }}" class="text-xs text-sky-600 font-semibold hover:text-sky-700 transition-colors">
                                Forgot Password?
                            </a>
                        </div>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                :type="showPass ? 'text' : 'password'"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                autocomplete="current-password"
                                required
                                data-label="Password"
                                oninvalid="const label = this.getAttribute('data-label') || 'Password'; let message = ''; if (this.validity.valueMissing) { message = label + ' wajib diisi.'; } this.setCustomValidity(message);"
                                oninput="this.setCustomValidity('');"
                                class="input-custom w-full rounded-xl pl-10 pr-11 py-3 text-sm transition-all duration-150"
                            >
                            <button type="button" @click="showPass = !showPass"
                                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                                    tabindex="-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Checkbox Keep me logged in --}}
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500 bg-slate-100">
                        <label for="remember" class="ml-2 block text-xs text-slate-500 font-medium select-none">
                            Keep me logged in
                        </label>
                    </div>

                    {{-- Button Submit --}}
                    <div class="pt-2">
                        <button
                            type="submit"
                            x-bind:disabled="loading"
                            class="w-full flex items-center justify-center gap-2 bg-[#0071bc] hover:bg-sky-700
                                   active:bg-sky-800 text-white font-semibold text-sm rounded-full py-3.5
                                   transition-all duration-150 shadow-md focus:outline-none"
                        >
                            <span x-show="!loading" class="flex items-center gap-1.5">
                                Sign In 
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                </svg>
                            </span>
                            <span x-show="loading" class="flex items-center gap-2" style="display:none">
                                <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                                </svg>
                                Authenticating...
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Footer Card (Don't have any account? Sign Up) --}}
            <div class="bg-slate-50 border-t border-slate-100 py-4 text-center text-xs font-medium">
                <span class="text-slate-500">Don't have any account?</span>
                <a href="{{ route('admin.register') }}" class="text-sky-700 hover:text-sky-800 font-bold transition-colors ml-0.5">
                    Sign Up
                </a>
            </div>
        </div>

        {{-- Pagination Dots Decorator --}}
        <div class="flex items-center gap-1.5 mt-6">
            <span class="w-8 h-0.5 rounded bg-slate-300"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
            <span class="w-8 h-0.5 rounded bg-slate-200/50"></span>
        </div>
    </main>

    {{-- Footer Bawah (Bottom Credits) -> PERBAIKAN: Menghubungkan link kosong ke rute yang pas --}}
    <footer class="w-full max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between border-t border-slate-300/40 pt-4 text-xs text-slate-500 gap-2 px-4">
        <div>© {{ date('Y') }} Kelompok 3.</div>
        <div class="flex items-center gap-5">
            <a href="{{ route('terms') }}" class="hover:text-slate-700 transition-colors">Terms of Service</a>
            <a href="{{ route('privacy.policy') }}" class="hover:text-slate-700 transition-colors">Privacy Policy</a>
            <a href="{{ route('admin.support') }}" class="hover:text-slate-700 transition-colors">Contact Support</a>
        </div>
    </footer>

</div>
@endsection