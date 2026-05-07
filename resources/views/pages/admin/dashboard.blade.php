@extends('layouts.admin')

@section('admin-content')
    <div class="space-y-6">
        <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div class="space-y-2">
                    <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Ringkasan dashboard</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Halo, {{ Auth::user()->name ?? 'Administrator' }}</h1>
                    <p class="max-w-2xl text-sm leading-6 text-slate-500">Pantau aktivitas destinasi dan pengguna secara cepat. Semua data penting tersedia di satu halaman untuk memudahkan keputusan Anda.</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <button class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah destinasi</button>
                    <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Export laporan</button>
                </div>
            </div>
        </header>

        <section class="grid gap-4 xl:grid-cols-3">
            <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Total Pengguna</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">1.284</p>
                <p class="mt-3 text-sm text-slate-500">Pengguna terdaftar aktif bulan ini.</p>
            </article>
            <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Destinasi Terdaftar</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">24</p>
                <p class="mt-3 text-sm text-slate-500">Jumlah destinasi yang sedang dikelola saat ini.</p>
            </article>
            <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Interaksi Pengunjung</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900">24.5K</p>
                <p class="mt-3 text-sm text-slate-500">Total kunjungan dan pencarian selama 30 hari terakhir.</p>
            </article>
        </section>

        <section class="grid gap-6 xl:grid-cols-[1.7fr_1fr]">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-6 xl:flex-row xl:items-center xl:justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Analitik Destinasi</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Destinasi paling banyak dilihat</h2>
                    </div>
                    <button class="rounded-full border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100">Filter</button>
                </div>

                <div class="mt-6 space-y-4">
                    <div class="flex flex-col gap-4 rounded-[1.5rem] bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Pura Tanah Lot</p>
                            <p class="text-sm text-slate-500">Bali Barat</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900">8.7K</p>
                            <p class="text-sm text-slate-500">Dilihat dalam 30 hari</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 rounded-[1.5rem] bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Uluwatu Temple</p>
                            <p class="text-sm text-slate-500">Bali Selatan</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900">6.2K</p>
                            <p class="text-sm text-slate-500">Dilihat dalam 30 hari</p>
                        </div>
                    </div>
                    <div class="flex flex-col gap-4 rounded-[1.5rem] bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Tegalalang Rice Terraces</p>
                            <p class="text-sm text-slate-500">Bali Utara</p>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900">5.4K</p>
                            <p class="text-sm text-slate-500">Dilihat dalam 30 hari</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm text-slate-500">Kinerja Sistem</p>
                            <h3 class="mt-2 text-xl font-semibold text-slate-900">Ringkasan real-time</h3>
                        </div>
                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700">Stabil</span>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Rata-rata waktu pemrosesan</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">4m 32s</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-4">
                            <p class="text-sm text-slate-500">Rekomendasi baru</p>
                            <p class="mt-2 text-2xl font-semibold text-slate-900">452</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">Aksi Cepat</p>
                            <h3 class="mt-2 text-xl font-semibold text-slate-900">Kelola cepat</h3>
                        </div>
                    </div>
                    <div class="mt-6 grid gap-3">
                        <button class="rounded-3xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Tambah pengguna baru</button>
                        <button class="rounded-3xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Tambah destinasi baru</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-6 xl:grid-cols-2">
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm text-slate-500">Destination Insights</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">Destinasi serupa</h3>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">Trend +12%</span>
                </div>
                <div class="mt-6 grid gap-4">
                    <div class="grid gap-3 rounded-[1.75rem] border border-slate-200 p-4 sm:grid-cols-[1fr_auto]">
                        <div>
                            <p class="font-semibold text-slate-900">Pantai Kuta</p>
                            <p class="mt-1 text-sm text-slate-500">Pantai populer untuk wisatawan keluarga.</p>
                        </div>
                        <span class="rounded-full bg-slate-50 px-3 py-1 text-sm text-slate-700">8.2K</span>
                    </div>
                    <div class="grid gap-3 rounded-[1.75rem] border border-slate-200 p-4 sm:grid-cols-[1fr_auto]">
                        <div>
                            <p class="font-semibold text-slate-900">Danau Beratan</p>
                            <p class="mt-1 text-sm text-slate-500">Wisata alam dan pura di dataran tinggi.</p>
                        </div>
                        <span class="rounded-full bg-slate-50 px-3 py-1 text-sm text-slate-700">6.7K</span>
                    </div>
                    <div class="grid gap-3 rounded-[1.75rem] border border-slate-200 p-4 sm:grid-cols-[1fr_auto]">
                        <div>
                            <p class="font-semibold text-slate-900">Tegalalang Rice Terrace</p>
                            <p class="mt-1 text-sm text-slate-500">Sawah terasering ikonik yang banyak dikunjungi.</p>
                        </div>
                        <span class="rounded-full bg-slate-50 px-3 py-1 text-sm text-slate-700">5.4K</span>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm text-slate-500">Notifikasi penting</p>
                <h3 class="mt-2 text-xl font-semibold text-slate-900">Tugas hari ini</h3>
                <div class="mt-6 space-y-4">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Review destinasi baru</p>
                        <p class="mt-2 text-sm text-slate-500">Periksa dan setujui destinasi yang ditambahkan oleh tim.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Cek laporan pengguna</p>
                        <p class="mt-2 text-sm text-slate-500">Lihat statistik pendaftaran pengguna dan interaksinya.</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm font-semibold text-slate-900">Backup data</p>
                        <p class="mt-2 text-sm text-slate-500">Pastikan data penting sudah dicadangkan sebelum perubahan.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection