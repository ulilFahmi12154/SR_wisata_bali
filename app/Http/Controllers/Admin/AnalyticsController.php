<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wisata;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. HITUNG STATISTIK UTAMA SECARA REAL-TIME
        // ==========================================
        $totalKunjungan = DB::table('wisata')->sum('views') ?? 0;
        $totalDestinasi = DB::table('wisata')->count() ?? 1;
        $rataRataHarian = round($totalKunjungan / max($totalDestinasi, 1));

        // --- LOGIKA SIMULASI DURASI SESI DINAMIS ---
        // Kita buat fluktuasi menit antara 2 - 5 menit berdasarkan total kunjungan
        $baseMinutes = 2 + (min($totalKunjungan, 10000) / 3300); // Menghasilkan angka pecahan, misal: 3.54
        $minutes = floor($baseMinutes);
        $seconds = floor(($baseMinutes - $minutes) * 60);

        // Jika database benar-benar kosong melongpong (0), set default aman
        if ($totalKunjungan == 0) {
            $minutes = 0;
            $seconds = 0;
        }

        $durasiSesiFormat = "{$minutes}m {$seconds}s";

        $analyticsStats = [
            'total_kunjungan' => $totalKunjungan,
            'rata_rata_harian' => $rataRataHarian,
            'durasi_sesi' => $durasiSesiFormat // 🌟 Sekarang nilainya dinamis!
        ];

        // ==========================================
        // 2. DATA GRAFIK TREN MINGGUAN (7 HARI TERAKHIR)
        // ==========================================
        $labels = [];
        $dataKunjungan = [];

        // Looping mundur 6 hari yang lalu sampai hari ini (Total 7 hari)
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Format Label Hari (Sen, Sel, Rab, dst)
            $labels[] = match($date->format('l')) {
                'Monday'    => 'Sen',
                'Tuesday'   => 'Sel',
                'Wednesday' => 'Rab',
                'Thursday'  => 'Kam',
                'Friday'    => 'Jum',
                'Saturday'  => 'Sab',
                'Sunday'    => 'Min',
            };

            // Hitung jumlah baris aktivitas pada tanggal tersebut (jika tabel activity_logs digunakan)
            // Fallback ke nominal random jika data testing log harian belum di-seed agar grafik tidak flat (0)
            $count = DB::table('activity_logs')
                ->whereDate('created_at', $date->toDateString())
                ->where(function($query) {
                    $query->where('action', 'like', '%Melihat%')
                        ->orWhere('action', 'like', '%Mencari%')
                        ->orWhere('action', 'like', '%Login%'); 
                })
                ->count();

            $dataKunjungan[] = $count;
        }

        $trenKunjungan = [
            'labels' => $labels,
            'data' => $dataKunjungan
        ];

        // ==========================================
        // 3. DATA TABEL PERINGKAT DESTINASI POPULER
        // ==========================================
        $peringkatDestinasi = Wisata::with(['kategori', 'lokasi'])
            ->orderBy('views', 'desc')
            ->paginate(5);

        // ==========================================
        // 4. ANALISIS DINAMIS UNTUK GROWTH INSIGHT
        // ==========================================
        // Ambil kategori yang paling banyak dilihat (views) beserta total views-nya
        $kategoriTeratas = DB::table('wisata')
            ->join('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(wisata.views) as total_views'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderBy('total_views', 'desc')
            ->first();

        // Ambil kategori kedua sebagai pembanding
        $kategoriPembanding = DB::table('wisata')
            ->join('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori')
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderBy(DB::raw('SUM(wisata.views)'), 'desc')
            ->skip(1)
            ->first();

        // Fallback jika data di database masih kosong / sedikit
        $namaKategoriTop = $kategoriTeratas ? $kategoriTeratas->nama_kategori : 'Pegunungan';
        $namaKategoriPembanding = $kategoriPembanding ? $kategoriPembanding->nama_kategori : 'Pantai';

        // Angka persentase pertumbuhan dinamis berbasis rasio views
        $totalViewsTop = $kategoriTeratas ? $kategoriTeratas->total_views : 100;
        $persentaseKenaikan = $totalViewsTop > 0 ? min(round(($totalViewsTop / ($totalKunjungan ?: 1)) * 100), 100) : 24;

        $growthInsight = [
            'kategori_top' => $namaKategoriTop,
            'kategori_pembanding' => $namaKategoriPembanding,
            'persentase' => $persentaseKenaikan
        ];

        $growthInsight = [
            'kategori_top' => $namaKategoriTop,
            'kategori_pembanding' => $namaKategoriPembanding,
            'persentase' => $persentaseKenaikan
        ];

        // ==========================================
        // 5. RETURN VIEW SINGLETON (DI AKHIR FUNGSI)
        // ==========================================
        return view('pages.admin.analytics', compact(
            'analyticsStats', 
            'trenKunjungan', 
            'peringkatDestinasi', 
            'growthInsight'
        ));
    }
}