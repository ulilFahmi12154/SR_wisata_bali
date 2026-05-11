<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BobotKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil atau buat kriteria terlebih dahulu
        $kriteriaRating = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Rating'],
            ['tipe' => 'benefit']
        );

        $kriteriaHargaWni = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Harga WNI'],
            ['tipe' => 'cost']
        );

        $kriteriaFasilitas = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Fasilitas'],
            ['tipe' => 'benefit']
        );

        $kriteriaHarga = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Harga'],
            ['tipe' => 'cost']
        );

        // Hapus data bobot_kriteria sebelumnya untuk menghindari duplikat
        DB::table('bobot_kriteria')->truncate();

        // Insert bobot_kriteria (Total bobot = 1.0)
        DB::table('bobot_kriteria')->insert([
            [
                'kriteria_id' => $kriteriaRating->id,
                'bobot' => 0.30, // 30%
            ],
            [
                'kriteria_id' => $kriteriaHargaWni->id,
                'bobot' => 0.25, // 25%
            ],
            [
                'kriteria_id' => $kriteriaFasilitas->id,
                'bobot' => 0.25, // 25%
            ],
            [
                'kriteria_id' => $kriteriaHarga->id,
                'bobot' => 0.20, // 20%
            ],
        ]);

        $this->command->info('Bobot Kriteria seeder berhasil dijalankan (Total bobot: 1.0).');
    }
}
