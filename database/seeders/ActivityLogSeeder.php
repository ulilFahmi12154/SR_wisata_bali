<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ActivityLog;
use App\Models\Wisata;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class ActivityLogSeeder extends Seeder
{
    public function run()
    {
        // Hapus data lama (opsional, komentar jika tidak ingin)
        ActivityLog::truncate();

        // Ambil semua id wisata yang memiliki kategori (untuk visit_detail)
        $wisataIds = Wisata::whereNotNull('kategori_id')->pluck('id')->toArray();
        if (empty($wisataIds)) {
            $this->command->warn('Tidak ada wisata dengan kategori. Lewati pembuatan visit_detail.');
        }

        // 1. Data kunjungan halaman (visit) – 100 baris acak dalam 7 hari terakhir
        for ($i = 0; $i < 100; $i++) {
            $date = Carbon::now()->subDays(rand(0, 6))->setTime(rand(0, 23), rand(0, 59));
            ActivityLog::create([
                'session_id'   => Session::getId(),
                'user_id'      => null,
                'wisata_id'    => null,
                'user_name'    => 'Guest',
                'action'       => 'Mengunjungi halaman',
                'action_type'  => 'visit',
                'search_keyword' => null,
                'icon'         => 'eye',
                'created_at'   => $date,
                'updated_at'   => $date,
                'url'          => '/',
                'ip_address'   => '127.0.0.1',
            ]);
        }

        // 2. Data pencarian (search) – 50 baris
        $keywords = ['pantai', 'gunung', 'budaya', 'kuliner', 'air terjun'];
        for ($i = 0; $i < 50; $i++) {
            $date = Carbon::now()->subDays(rand(0, 6))->setTime(rand(0, 23), rand(0, 59));
            $keyword = $keywords[array_rand($keywords)];
            ActivityLog::create([
                'session_id'   => Session::getId(),
                'user_id'      => null,
                'wisata_id'    => null,
                'user_name'    => 'Guest',
                'action'       => "Mencari \"$keyword\"",
                'action_type'  => 'search',
                'search_keyword' => $keyword,
                'icon'         => 'search',
                'created_at'   => $date,
                'updated_at'   => $date,
                'url'          => '/destinasi?search=' . urlencode($keyword),
                'ip_address'   => '127.0.0.1',
            ]);
        }

        // 3. Data login – 30 baris (user_id acak 1-5)
        for ($i = 0; $i < 30; $i++) {
            $date = Carbon::now()->subDays(rand(0, 6))->setTime(rand(0, 23), rand(0, 59));
            $userId = rand(1, 5);
            ActivityLog::create([
                'session_id'   => Session::getId(),
                'user_id'      => $userId,
                'wisata_id'    => null,
                'user_name'    => "User $userId",
                'action'       => 'User login',
                'action_type'  => 'login',
                'search_keyword' => null,
                'icon'         => 'login',
                'created_at'   => $date,
                'updated_at'   => $date,
                'url'          => '/login',
                'ip_address'   => '127.0.0.1',
            ]);
        }

        // 4. Data kunjungan detail destinasi (visit_detail) – 200 baris, menggunakan wisata_id yang valid
        if (!empty($wisataIds)) {
            for ($i = 0; $i < 200; $i++) {
                $date = Carbon::now()->subDays(rand(0, 6))->setTime(rand(0, 23), rand(0, 59));
                ActivityLog::create([
                    'session_id'   => Session::getId(),
                    'user_id'      => null,
                    'wisata_id'    => $wisataIds[array_rand($wisataIds)],
                    'user_name'    => 'Guest',
                    'action'       => 'Melihat detail destinasi',
                    'action_type'  => 'visit_detail',
                    'search_keyword' => null,
                    'icon'         => 'eye',
                    'created_at'   => $date,
                    'updated_at'   => $date,
                    'url'          => '/destinasi/1',
                    'ip_address'   => '127.0.0.1',
                ]);
            }
        }

        $this->command->info('Seeder ActivityLogSeeder selesai. Data dummy berhasil ditambahkan.');
    }
}