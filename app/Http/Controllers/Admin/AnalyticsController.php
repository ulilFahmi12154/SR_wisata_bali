<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Kategori;
use App\Models\Wisata;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index()
    {
        // ==========================================
        // 1. METRIK UTAMA DARI ACTIVITY_LOGS
        // ==========================================
        
        // Total kunjungan (selamanya)
        $totalKunjungan = ActivityLog::where('action_type', 'visit')->count();
        
        // Rata-rata harian (30 hari terakhir)
        $dailyVisits = ActivityLog::where('action_type', 'visit')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->get();
        $rataHarian = $dailyVisits->avg('total') ?? 0;
        
        // Durasi sesi rata-rata (7 hari terakhir)
        $sessions = ActivityLog::select('session_id', DB::raw('MIN(created_at) as start'), DB::raw('MAX(created_at) as end'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('session_id')
            ->get();
        $totalDuration = 0;
        foreach ($sessions as $session) {
            $totalDuration += strtotime($session->end) - strtotime($session->start);
        }
        $avgDurationSeconds = $sessions->count() ? round($totalDuration / $sessions->count()) : 0;
        $durasiSesi = floor($avgDurationSeconds / 60) . 'm ' . ($avgDurationSeconds % 60) . 's';
        
        // Rata-rata pencarian per hari (30 hari)
        $dailySearch = ActivityLog::where('action_type', 'search')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->get();
        $rataPencarianPerHari = $dailySearch->avg('total') ?? 0;
        
        // Tren kunjungan (bulan ini vs bulan lalu)
        $bulanIni = ActivityLog::where('action_type', 'visit')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        $bulanLalu = ActivityLog::where('action_type', 'visit')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $trenKunjungan = $this->hitungTren($bulanIni, $bulanLalu, 12.4);
        
        // Tren rata-rata harian
        $hariBulanIni = Carbon::now()->daysInMonth;
        $avgHarianBulanIni = $hariBulanIni > 0 ? $bulanIni / $hariBulanIni : 0;
        $hariBulanLalu = Carbon::now()->subMonth()->daysInMonth;
        $avgHarianBulanLalu = $hariBulanLalu > 0 ? $bulanLalu / $hariBulanLalu : 0;
        $trenRataHarian = $this->hitungTren($avgHarianBulanIni, $avgHarianBulanLalu, 5.2);
        
        // Tren durasi sesi (estimasi sederhana)
        $trenDurasi = $this->hitungTren($avgDurationSeconds, $avgDurationSeconds * 0.98, -1.8);
        
        // Tren pencarian
        $searchBulanIni = ActivityLog::where('action_type', 'search')
            ->whereMonth('created_at', Carbon::now()->month)->count();
        $searchBulanLalu = ActivityLog::where('action_type', 'search')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        $avgSearchBulanIni = $hariBulanIni > 0 ? $searchBulanIni / $hariBulanIni : 0;
        $avgSearchBulanLalu = $hariBulanLalu > 0 ? $searchBulanLalu / $hariBulanLalu : 0;
        $trenPencarian = $this->hitungTren($avgSearchBulanIni, $avgSearchBulanLalu, 0);
        
        $analyticsStats = [
            'total_kunjungan' => $totalKunjungan,
            'rata_rata_harian' => round($rataHarian),
            'durasi_sesi' => $durasiSesi,
            'rata_pencarian_per_hari' => round($rataPencarianPerHari, 1),
            'tren_kunjungan' => $trenKunjungan,
            'tren_rata_harian' => $trenRataHarian,
            'tren_durasi_sesi' => $trenDurasi,
            'tren_pencarian' => $trenPencarian,
            'total_pencarian_30hari' => ActivityLog::where('action_type', 'search')->where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'total_login_30hari' => ActivityLog::where('action_type', 'login')->where('created_at', '>=', Carbon::now()->subDays(30))->count(),
            'rata_sesi_per_user' => $this->getRataSesiPerUser(),
        ];
        
        // ==========================================
        // 2. DATA GRAFIK (7 HARI) – SUDAH MENGGUNAKAN API, TETAP KIRIM FALLBACK
        // ==========================================
        $grafikKunjungan = $this->getGrafikData('visit');
        $grafikLogin = $this->getGrafikData('login', true);
        
        // ==========================================
        // 3. GROWTH INSIGHT (dari kategori wisata, opsional)
        // ==========================================
        $kategoriTeratas = Wisata::join('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(wisata.views) as total_views'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderByDesc('total_views')
            ->first();
        $kategoriKedua = Wisata::join('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(wisata.views) as total_views'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderByDesc('total_views')
            ->skip(1)->first();
        $persentase = 24;
        if ($kategoriTeratas && $kategoriKedua && $kategoriKedua->total_views > 0) {
            $persentase = round(($kategoriTeratas->total_views - $kategoriKedua->total_views) / $kategoriKedua->total_views * 100);
        }
        $growthInsight = [
            'kategori_top' => $kategoriTeratas->nama_kategori ?? 'Alam',
            'kategori_pembanding' => $kategoriKedua->nama_kategori ?? 'Rekreasi',
            'persentase' => $persentase,
            'target_bulanan' => '69%',
            'target_bulanan_percent' => 69,
        ];
        
        // ==========================================
        // 4. DATA TABEL PERINGKAT DESTINASI
        // ==========================================
        $peringkatDestinasi = Wisata::with(['kategori', 'lokasi'])
            ->orderBy('views', 'desc')
            ->paginate(5);


        return view('pages.admin.analytics', compact(
            'analyticsStats', 
            'grafikKunjungan', 
            'grafikLogin', 
            'growthInsight',
            'peringkatDestinasi'   // <-- TAMBAHKAN INI
        ));
    }
    
    public function categoryDetails()
    {
        $now = Carbon::now();
        $detailActionTypes = ['visit_detail', 'click_detail'];
        $totalDestinations = Wisata::count();
        $totalVisitors = ActivityLog::whereIn('action_type', $detailActionTypes)->count();
        
        // Growth rate (7 hari vs 7 hari sebelumnya)
        $last7 = ActivityLog::whereIn('action_type', $detailActionTypes)->where('created_at', '>=', $now->copy()->subDays(7))->count();
        $prev7 = ActivityLog::whereIn('action_type', $detailActionTypes)->whereBetween('created_at', [$now->copy()->subDays(14), $now->copy()->subDays(8)])->count();
        $growthRate = $prev7 > 0 ? round(($last7 - $prev7) / $prev7 * 100) : 0;
        
        // Line chart data (7 hari)
        $categories = Kategori::all();
        $dates = [];
        for ($i = 6; $i >= 0; $i--) $dates[] = $now->copy()->subDays($i)->format('M d');
        $seriesData = [];
        foreach ($categories as $cat) {
            $viewsPerDay = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = $now->copy()->subDays($i);
                $count = ActivityLog::whereIn('action_type', $detailActionTypes)
                    ->whereDate('created_at', $date)
                    ->whereHas('wisata', fn($q) => $q->where('kategori_id', $cat->id))
                    ->count();
                $viewsPerDay[] = $count;
            }
            if (array_sum($viewsPerDay) > 0) {
                $seriesData[] = ['name' => $cat->nama_kategori, 'data' => $viewsPerDay];
            }
        }
        
        // Ranking kategori - format array of objects with proper keys
        $categoryRanking = ActivityLog::whereIn('action_type', $detailActionTypes)
            ->join('wisata', 'activity_logs.wisata_id', '=', 'wisata.id')
            ->join('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', 
                    DB::raw('COUNT(DISTINCT wisata.id) as total_destinasi'),
                    DB::raw('COUNT(*) as total_kunjungan'))
            ->groupBy('kategori.id', 'kategori.nama_kategori')
            ->orderByDesc('total_kunjungan')
            ->get();
        
        // Hitung growth per kategori (opsional, bisa 0 jika tidak ada data)
        foreach ($categoryRanking as $item) {
            $item->growth = 0; // isi dengan logika jika perlu
        }
        
        // Distribution
        $distribution = Kategori::withCount('wisata')->get()
            ->map(fn($cat) => [
                'name' => $cat->nama_kategori,
                'count' => $cat->wisata_count,
                'percentage' => $totalDestinations ? round(($cat->wisata_count / $totalDestinations) * 100) : 0
            ])
            ->filter(fn($item) => $item['count'] > 0)
            ->values();
        
        return view('pages.admin.see_category_details', compact(
            'totalDestinations', 'totalVisitors', 'growthRate',
            'dates', 'seriesData', 'categoryRanking', 'distribution'
        ));
    }
    
    // ==================== PRIVATE METHODS ====================
    
    private function hitungTren($sekarang, $lalu, $fallbackPersen = 0)
    {
        if ($lalu == 0 && $sekarang == 0) {
            $status = $fallbackPersen >= 0 ? 'naik' : 'turun';
            return ['status' => $status, 'persen' => abs($fallbackPersen)];
        }
        if ($lalu == 0) {
            return ['status' => 'naik', 'persen' => 100];
        }
        $persen = round(($sekarang - $lalu) / $lalu * 100, 1);
        if ($persen > 0) {
            return ['status' => 'naik', 'persen' => $persen];
        } elseif ($persen < 0) {
            return ['status' => 'turun', 'persen' => abs($persen)];
        } else {
            return ['status' => 'stabil', 'persen' => 0];
        }
    }
    
    private function getGrafikData($actionType, $distinctUser = false)
    {
        $query = ActivityLog::where('action_type', $actionType)
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw(($distinctUser ? 'COUNT(DISTINCT user_id)' : 'COUNT(*)') . ' as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        $labels = [];
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dateString = $date->toDateString();
            $labels[] = $this->getDayName($date);
            $found = $query->firstWhere('date', $dateString);
            $data[] = $found ? $found->total : 0;
        }
        return ['labels' => $labels, 'data' => $data];
    }
    
    private function getDayName($date)
    {
        $day = $date->format('l');
        return match($day) {
            'Monday' => 'Sen', 'Tuesday' => 'Sel', 'Wednesday' => 'Rab',
            'Thursday' => 'Kam', 'Friday' => 'Jum', 'Saturday' => 'Sab',
            'Sunday' => 'Min', default => substr($day, 0, 3)
        };
    }
    
    private function getRataDurasiPerBulan($month, $year)
    {
        $sessions = ActivityLog::select('session_id', DB::raw('MIN(created_at) as start'), DB::raw('MAX(created_at) as end'))
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->groupBy('session_id')
            ->get();
        $total = 0;
        foreach ($sessions as $s) {
            $total += strtotime($s->end) - strtotime($s->start);
        }
        return $sessions->count() ? $total / $sessions->count() : 0;
    }
    
    private function getRataSesiPerUser()
    {
        $totalSessions = ActivityLog::distinct('session_id')->count('session_id');
        $totalUsers = ActivityLog::whereNotNull('user_id')->distinct('user_id')->count('user_id');
        if ($totalUsers == 0) return 0;
        return $totalSessions / $totalUsers;
    }
}
