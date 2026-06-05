<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. STATISTIK UTAMA (COUNTER CARDS)
        // ==========================================
        
        // Menghitung user dengan role 'traveler' atau 'user' (Sesuaikan enum role database Anda)
        $totalUser = DB::table('users')->where('role', '!=', 'admin')->count();

        // Menghitung user baru bulan ini & bulan lalu untuk mencari persentase pertumbuhan
        $userBulanIni = DB::table('users')
            ->where('role', '!=', 'admin')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $userBulanLalu = DB::table('users')
            ->where('role', '!=', 'admin')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();

        // Hitung persentase pertumbuhan ala dashboard profesional
        if ($userBulanLalu > 0) {
            $growth = round((($userBulanIni - $userBulanLalu) / $userBulanLalu) * 100);
            $persentaseUserBaru = ($growth >= 0 ? '+' : '') . $growth . '% bln ini';
        } else {
            $persentaseUserBaru = $userBulanIni > 0 ? '+' . $userBulanIni . ' baru' : '0 bln ini';
        }

        // Menghitung total baris di tabel wisata
        $totalWisata = DB::table('wisata')->count();

        // Menghitung akumulasi total views/kunjungan dari tabel wisata
        $totalViews = DB::table('wisata')->sum('views') ?? 0;
        
        // Format angka besar ke satuan ribuan (K) atau jutaan (M) sesuai mockup
        if ($totalViews >= 1000000) {
            $totalKunjunganFormat = round($totalViews / 1000000, 1) . 'M';
        } elseif ($totalViews >= 1000) {
            $totalKunjunganFormat = round($totalViews / 1000, 1) . 'K';
        } else {
            $totalKunjunganFormat = $totalViews;
        }

        $stats = [
            'total_user' => $totalUser,
            'total_wisata' => $totalWisata,
            'total_kunjungan' => $totalKunjunganFormat,
            'persentase_user_baru' => $persentaseUserBaru
        ];

        // ==========================================
        // 2. DESTINASI WISATA TERPOPULER
        // ==========================================
        // Ambil angka views tertinggi, jika 0 paksa ke 1 untuk menghindari Division by Zero error
        $wisataMaksimalViews = DB::table('wisata')->max('views') ?? 1;
        $wisataMaksimalViews = $wisataMaksimalViews == 0 ? 1 : $wisataMaksimalViews;
        
        // Ambil 3 tempat wisata dengan views terbanyak
        $popularDestinationsFromDb = DB::table('wisata')
            ->orderBy('views', 'desc')
            ->limit(3)
            ->get();

        $popularDestinations = [];
        foreach ($popularDestinationsFromDb as $index => $dest) {
            $percentage = ($dest->views / $wisataMaksimalViews) * 100;

            // Cari nama daerah/lokasi melalui joinalternatif jika kolom lokasi_id digunakan
            $lokasiNama = 'Bali';
            if (isset($dest->lokasi_id)) {
                $lokasiData = DB::table('lokasi')->where('id', $dest->lokasi_id)->first();
                $lokasiNama = $lokasiData->nama_daerah ?? 'Bali';
            }

            $popularDestinations[] = [
                'rank'        => $index + 1,
                'name'        => $dest->nama ?? 'Tujuan Tidak Diketahui',
                // Kondisional URL asset langsung dari controller
                'image'       => $dest->image ? asset($dest->image) : asset('images/default-wisata.jpg'), 
                'location'    => $lokasiNama,
                'views'       => $dest->total_views ?? 0, 
                'percentage'  => $percentage,
            ];
        }

        // ==========================================
        // 3. AKTIVITAS TERKINI (TIMELINE LOG)
        // ==========================================
        $activitiesFromDb = DB::table('activity_logs')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        $activities = [];
        foreach ($activitiesFromDb as $act) {
            $activities[] = [
                'user' => $act->user_name,
                'action' => $act->action,
                'time' => Carbon::parse($act->created_at)->diffForHumans(),
                'icon' => $act->icon ?? '🔍' // Fallback icon jika kosong
            ];
        }

        return view('pages.admin.dashboard', compact('stats', 'popularDestinations', 'activities'));
    }
}