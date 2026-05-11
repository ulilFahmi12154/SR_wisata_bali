<?php

namespace App\Http\Controllers;

use App\Models\Wisata;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua wisata + relasi yang dibutuhkan
        $wisataPopuler = Wisata::with([
            'fasilitas',
            'kategori',
            'lokasi'
        ])
        ->get()
        ->map(function ($wisata) {

            // =========================
            // HITUNG JUMLAH FASILITAS
            // =========================
            $jumlahFasilitas = $wisata->fasilitas->count();


            // =========================
            // HARGA SCORE
            // makin murah makin tinggi
            // =========================
            $harga = $wisata->harga_wni_min ?? 0;

            if ($harga == 0) {
                $hargaScore = 5;
            } elseif ($harga <= 10000) {
                $hargaScore = 4;
            } elseif ($harga <= 50000) {
                $hargaScore = 3;
            } elseif ($harga <= 100000) {
                $hargaScore = 2;
            } else {
                $hargaScore = 1;
            }


            // =========================
            // VIEWS
            // sementara default 0
            // nanti tinggal tambah kolom
            // =========================
            $views = $wisata->views ?? 0;


            // =========================
            // POPULARITY SCORE
            // =========================
            $score =
                (($wisata->rating ?? 0) * 40)
                + ($jumlahFasilitas * 20)
                + ($hargaScore * 10)
                + ($views * 30);


            // simpan score sementara
            $wisata->popularity_score = $score;

            return $wisata;
        })

        // urutkan score terbesar
        ->sortByDesc('popularity_score')

        // ambil 6 wisata teratas
        ->take(6);


        return view('pages.landingpage', [
            'wisataPopuler' => $wisataPopuler->values()
        ]);
    }
}