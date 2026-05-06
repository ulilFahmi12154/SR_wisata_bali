<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wisata;
use App\Models\Kategori;
use App\Models\Lokasi;
use App\Models\Fasilitas;
use App\Models\Penilaian;
use App\Models\Kriteria;
use Illuminate\Support\Facades\DB;

class WisataSeeder extends Seeder
{
    public function run(): void
    {
        // 0. CARI ATAU BUAT KRITERIA (Tanpa memaksa ID)
        // Kita gunakan firstOrCreate berdasarkan nama_kriteria
        $kriteriaRating = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Rating'],
            ['tipe' => 'benefit']
        );

        $kriteriaHarga = Kriteria::firstOrCreate(
            ['nama_kriteria' => 'Harga WNI'],
            ['tipe' => 'cost']
        );

        // 1. Path ke file CSV kamu
        $file = database_path('data/Dataset_Lokasi_Wisata_Pulau_Bali.done.csv');
        $csvData = fopen($file, 'r');

        $isHeader = true;

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            while (($row = fgetcsv($csvData, 2000, ",")) !== FALSE) {
                if ($isHeader) {
                    $isHeader = false;
                    continue;
                }

                $nama           = $row[0] ?? null;
                $nama_kategori  = $row[1] ?? null;
                $nama_lokasi    = $row[2] ?? null;
                $rating         = $row[3] ?? null;
                $raw_price_wni  = $row[5] ?? '';
                $raw_price_wna  = $row[6] ?? '';
                $raw_fasilitas  = $row[7] ?? '';
                $jam_ops        = $row[8] ?? null;
                $keterangan     = $row[9] ?? null;
                $link           = $row[10] ?? null;
                $lat            = $row[11] ?? null;
                $lng            = $row[12] ?? null;
                $deskripsi      = $row[13] ?? null;
                $image          = $row[14] ?? null;

                if (empty($nama)) continue;

                // --- TRANSFORM: Kategori & Lokasi ---
                $kategori = Kategori::firstOrCreate(['nama_kategori' => $nama_kategori]);
                $lokasi   = Lokasi::firstOrCreate(['nama_kabupaten' => $nama_lokasi]);

                // --- TRANSFORM: Range Price WNI ---
                // 1. Bersihkan Rp, Titik, dan Spasi
                $clean_wni = str_replace(['Rp', '.', ' '], '', $raw_price_wni);

                // 2. Pecah menggunakan Regex untuk menangkap segala jenis tanda hubung (dash)
                // Karakter [-\x{2013}\x{2014}] menangkap hyphen (-), en-dash (–), dan em-dash (—)
                $prices_wni = preg_split('/[-\x{2013}\x{2014}]/u', $clean_wni);

                $wni_min = (isset($prices_wni[0]) && is_numeric($prices_wni[0])) ? (int)$prices_wni[0] : 0;
                // Jika prices_wni[1] ada, gunakan itu. Jika tidak, gunakan min.
                $wni_max = (isset($prices_wni[1]) && is_numeric($prices_wni[1])) ? (int)$prices_wni[1] : $wni_min;

                // --- TRANSFORM: Range Price WNA ---
                $clean_wna = str_replace(['Rp', '.', ' '], '', $raw_price_wna);
                $prices_wna = preg_split('/[-\x{2013}\x{2014}]/u', $clean_wna);

                $wna_min = (isset($prices_wna[0]) && is_numeric($prices_wna[0])) ? (int)$prices_wna[0] : 0;
                $wna_max = (isset($prices_wna[1]) && is_numeric($prices_wna[1])) ? (int)$prices_wna[1] : $wna_min;

                // --- LOAD: Tabel Wisata ---
                $wisata = Wisata::create([
                    'nama'           => $nama,
                    'kategori_id'    => $kategori->id,
                    'lokasi_id'      => $lokasi->id,
                    'harga_wni_min'  => $wni_min,
                    'harga_wni_max'  => $wni_max,
                    'harga_wna_min'  => $wna_min,
                    'harga_wna_max'  => $wna_max,
                    'rating'         => is_numeric($rating) ? (float)$rating : null,
                    'deskripsi'      => $deskripsi,
                    'keterangan'     => $keterangan,
                    'jam_operasional' => $jam_ops,
                    'link'           => $link,
                    'latitude'       => is_numeric($lat) ? (float)$lat : null,
                    'longitude'      => is_numeric($lng) ? (float)$lng : null,
                    'image'          => $image,
                ]);

                // --- TRANSFORM & LOAD: Fasilitas ---
                if (!empty($raw_fasilitas)) {
                    $list_fasilitas = explode(',', $raw_fasilitas);
                    foreach ($list_fasilitas as $item) {
                        $nama_fasilitas = trim($item);
                        if (!empty($nama_fasilitas)) {
                            $f = Fasilitas::firstOrCreate(['nama_fasilitas' => $nama_fasilitas]);
                            $wisata->fasilitas()->attach($f->id);
                        }
                    }
                }

                // --- LOAD: Tabel Penilaian ---
                // 1. Penilaian Rating
                Penilaian::create([
                    'wisata_id'   => $wisata->id,
                    'kriteria_id' => $kriteriaRating->id,
                    // Kita ubah dulu ke (float) baru di-round, untuk menghindari TypeError
                    'nilai'       => round((float) $rating, 2)
                ]);

                // 2. Penilaian Harga (diambil dari harga minimal)
                if ($wni_min !== null) {
                    $skorHarga = 0.0;
                    if ($wni_min == 0) $skorHarga = 5.0;
                    elseif ($wni_min <= 5000) $skorHarga = 4.5;
                    elseif ($wni_min <= 15000) $skorHarga = 4.0;
                    elseif ($wni_min <= 50000) $skorHarga = 3.0;
                    elseif ($wni_min <= 100000) $skorHarga = 2.0;
                    else $skorHarga = 1.0;
                    Penilaian::create([
                        'wisata_id'   => $wisata->id,
                        'kriteria_id' => $kriteriaHarga->id,
                        'nilai'       => (float) $skorHarga
                    ]);
                }
            }

            DB::commit();
            $this->command->info("ETL Berhasil! Data Wisata Bali sukses dimasukkan.");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->command->error("Gagal Import: " . $e->getMessage());
        }

        fclose($csvData);
    }
}
