@extends('layouts.app')

@section('title', 'Reset Password Admin — Jelajah Bali')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Menerapkan font baru ke seluruh halaman agar serasi */
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Latar belakang gradasi smooth pastel mesh sesuai gambar */
    .admin-bg {
        background: linear-gradient(135deg, #dce7e1 0%, #e2ebed 50%, #e6e3eb 100%);
    }
    
    /* Kartu putih bersih dengan bayangan sangat halus */
    .card-custom {
        background: #ffffff;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.03);
    }
    
    /* Font "Admin Portal" disesuaikan ketebalan & warnanya (Dark Navy) */
    .title-brand {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #11253e;
        font-weight: 800; /* Extra Bold sesuai contoh */
        letter-spacing: -0.03em;
    }
    
    /* Input abu-abu muda khas tanpa border bawaan */
    .input-custom {
        background: #eef1f4;
        border: 1px solid transparent;
        color: #1f2937;
    }
    .input-custom::placeholder { 
        color: #9ca3af; 
    }
    .input-custom:focus {
        outline: none;
        background: #ffffff;
        border-color: #0071a9;
        box-shadow: 0 0 0 4px rgba(0, 113, 169, 0.15);
    }
    
    /* Tombol biru pill-shaped (rounded-full) dengan drop shadow sesuai gambar */
    .btn-custom {
        background: #0071a9;
        box-shadow: 0 4px 14px rgba(0, 113, 169, 0.3);
    }
    .btn-custom:hover {
        background: #005f8f;
    }
</style>
@endpush

@section('body')
<div class="min-h-screen admin-bg relative flex flex-col items-center justify-center p-6 overflow-hidden">

    {{-- Card Container --}}
    <div class="relative w-full max-w-[440px] card-custom rounded-[32px] p-10 flex flex-col items-center">

        {{-- Top Pill Badge --}}
        <span class="px-4 py-1 rounded-full bg-[#e3e3e3] text-[#757575] font-bold uppercase tracking-widest text-[9px] mb-4">
            Sistem Administrasi
        </span>

        {{-- Brand Title --}}
        <h1 class="title-brand text-[32px] text-center leading-tight">
            Admin Portal
        </h1>
        
        {{-- Green Accent Line --}}
        <div class="w-9 h-[3px] bg-[#1d6333] rounded-full my-4"></div>
        
        {{-- Section Header --}}
        <h2 class="text-[#1a1a1a] font-bold text-[21px] tracking-tight text-center mt-1">Reset Kata Sandi Admin</h2>
        <p class="text-[#555555] text-xs mt-2.5 text-center max-w-[290px] leading-relaxed">
            Masukkan email akademik Anda untuk menerima tautan pemulihan kata sandi.
        </p>

        {{-- Success Message Container --}}
        @if (session('status'))
            <div class="w-full rounded-xl bg-emerald-50 border border-emerald-200 p-4 mt-6">
                <div class="flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="text-emerald-800 text-sm font-semibold">Email terkirim!</p>
                        <p class="text-emerald-600 text-xs mt-0.5">{{ session('status') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form Area --}}
        @unless (session('status'))
        <form action="{{ route('admin.password.email') }}" method="POST" class="w-full space-y-5 mt-7"
              x-data="{ loading: false }" @submit="loading = true">
            @csrf

            {{-- Input Email --}}
            <div class="space-y-2">
                <label for="email" class="block text-xs font-bold text-[#444444] text-left pl-0.5">
                    Email Address
                </label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
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
                        class="input-custom w-full rounded-xl pl-11 pr-4 py-3.5 text-sm transition-all duration-150"
                    >
                </div>
                @error('email')
                    <p class="text-xs text-red-500 flex items-center gap-1 mt-1 pl-0.5">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                x-bind:disabled="loading"
                class="btn-custom w-full flex items-center justify-center gap-2 text-white font-medium text-sm rounded-full py-3.5 mt-2
                       transition-all duration-150 disabled:opacity-60 disabled:cursor-not-allowed"
            >
                <span x-show="!loading" class="flex items-center gap-1.5">
                    Kirim Tautan Pemulihan 
                    <svg class="w-3.5 h-3.5 mt-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </span>
                <span x-show="loading" class="flex items-center gap-2" style="display:none">
                    <svg class="animate-spin w-4 h-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    Mengirim...
                </span>
            </button>

        </form>
        @endunless

        {{-- Back Link Section --}}
        <div class="mt-9 w-full text-center border-t border-gray-100/70 pt-6">
            <a href="{{ route('admin.login') }}"
               class="inline-flex items-center gap-1 text-xs font-bold text-[#0071a9] hover:text-[#005f8f] transition-colors">
                &lsaquo; Kembali ke Login
            </a>
        </div>

    </div>

    {{-- Footer Text Outside Card --}}
    <p class="mt-8 text-center text-[#8e9896] text-[10px] font-medium tracking-widest max-w-md mx-auto leading-relaxed">
        &copy; 2026 THE CURATED HORIZON. KELOMPOK 3.
    </p>
</div>
@endsection