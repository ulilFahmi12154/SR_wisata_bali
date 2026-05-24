<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Kriteria;
use App\Models\Lokasi;
use App\Models\Penilaian;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class RekomendasiController extends Controller
{
    public function show($id)
    {
        $destination = DB::table('wisata')
            ->leftJoin('lokasi', 'wisata.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('wisata.*', 'lokasi.nama_kabupaten', 'kategori.nama_kategori')
            ->where('wisata.id', $id)
            ->first();

        if (!$destination) {
            return redirect()->back()->with('error', 'Destinasi tidak ditemukan.');
        }

        // Simpan ke core memory: Schema tabel 'wisata' menggunakan 'keterangan' atau 'deskripsi'
        // 'image' berisi nama file yang ada di public/images/destination/

        // Ambil fasilitas terkait
        $facilities = DB::table('wisata_fasilitas')
            ->join('fasilitas', 'wisata_fasilitas.fasilitas_id', '=', 'fasilitas.id')
            ->where('wisata_fasilitas.wisata_id', $id)
            ->pluck('fasilitas.nama_fasilitas');

        // Ambil rekomendasi serupa (misal berdasarkan kategori yang sama)
        $recommendations = DB::table('wisata')
            ->leftJoin('lokasi', 'wisata.lokasi_id', '=', 'lokasi.id')
            ->leftJoin('kategori', 'wisata.kategori_id', '=', 'kategori.id')
            ->select('wisata.*', 'lokasi.nama_kabupaten', 'kategori.nama_kategori')
            ->where('wisata.kategori_id', $destination->kategori_id)
            ->where('wisata.id', '!=', $id)
            ->limit(3)
            ->get();

        return view('pages.user.destinations.detail', compact('destination', 'facilities', 'recommendations'));
    }

    public function index(Request $request)
    {
        $perPage = 12;
        $sortOptions = [
            'terbaru' => 'Terbaru',
            'name_asc' => 'Nama A-Z',
            'rating_desc' => 'Rating Tertinggi',
            'harga_asc' => 'Harga Terendah',
            'harga_desc' => 'Harga Tertinggi',
        ];

        $search = trim((string) $request->query('search', ''));
        $kategoriId = $request->filled('kategori_id') ? (int) $request->query('kategori_id') : null;
        $lokasiId = $request->filled('lokasi_id') ? (int) $request->query('lokasi_id') : null;
        $sort = (string) $request->query('sort', 'terbaru');
        $sort = array_key_exists($sort, $sortOptions) ? $sort : 'terbaru';

        $destinationsQuery = Wisata::query()
            ->with(['lokasi', 'kategori']);

        if ($search !== '') {
            $destinationsQuery->where(function ($query) use ($search) {
                $like = '%' . $search . '%';

                $query->where('nama', 'like', $like)
                    ->orWhere('deskripsi', 'like', $like)
                    ->orWhere('keterangan', 'like', $like)
                    ->orWhereHas('lokasi', function ($locationQuery) use ($like) {
                        $locationQuery->where('nama_kabupaten', 'like', $like);
                    });
            });
        }

        if ($kategoriId) {
            $destinationsQuery->where('kategori_id', $kategoriId);
        }

        if ($lokasiId) {
            $destinationsQuery->where('lokasi_id', $lokasiId);
        }

        match ($sort) {
            'name_asc' => $destinationsQuery->orderBy('nama'),
            'rating_desc' => $destinationsQuery->orderByDesc('rating')->orderBy('nama'),
            'harga_asc' => $destinationsQuery->orderByRaw('COALESCE(harga_wni_min, harga_wna_min, 0) ASC')->orderBy('nama'),
            'harga_desc' => $destinationsQuery->orderByRaw('COALESCE(harga_wni_min, harga_wna_min, 0) DESC')->orderBy('nama'),
            default => $destinationsQuery->orderByDesc('created_at')->orderByDesc('id'),
        };

        $destinationsPaginator = $destinationsQuery
            ->paginate($perPage)
            ->appends($request->query());

        $hasCatalogFilters = $search !== '' || $kategoriId || $lokasiId || $sort !== 'terbaru';

        return view('pages.user.destinations.index', [
            'destinations' => $destinationsPaginator->getCollection(),
            'destinationsPaginator' => $destinationsPaginator,
            'totalDestinations' => $destinationsPaginator->total(),
            'totalAvailableDestinations' => Wisata::query()->count(),
            'categories' => Kategori::query()->orderBy('nama_kategori')->get(['id', 'nama_kategori']),
            'locations' => Lokasi::query()->orderBy('nama_kabupaten')->get(['id', 'nama_kabupaten']),
            'filters' => [
                'search' => $search,
                'kategori_id' => $kategoriId,
                'lokasi_id' => $lokasiId,
                'sort' => $sort,
            ],
            'sortOptions' => $sortOptions,
            'hasCatalogFilters' => $hasCatalogFilters,
            'perPage' => $perPage,
        ]);
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'regency' => ['nullable', 'string', 'max:80'],
            'interest' => ['nullable', 'string', 'max:80'],
            'budget' => ['nullable', 'integer', 'min:0', 'max:10000000'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['string', 'max:80'],
        ]);

        $query = [
            'submitted' => 1,
            'regency' => $validated['regency'] ?? 'all',
            'interest' => $validated['interest'] ?? 'all',
            'budget' => $validated['budget'] ?? 500000,
        ];

        $amenities = array_values(array_filter($validated['amenities'] ?? []));

        if (!empty($amenities)) {
            $query['amenities'] = $amenities;
        }

        return redirect()->route('user.recommendations.results', $query);
    }

    public function results(Request $request)
    {
        $regency = $request->input('regency');
        $interest = $request->input('interest');
        $budget = $request->input('budget');
        $amenities = (array) $request->input('amenities', []);

        if (!$request->boolean('submitted') || !$request->has(['regency', 'interest', 'budget'])) {
            return redirect()
                ->route('user.home')
                ->with('status', 'Silakan isi preferensi perjalanan terlebih dahulu.');
        }

        $filterSummary = $this->buildFilterSummary($regency, $interest, $budget, $amenities);

        $wisataQuery = Wisata::query()->with(['lokasi', 'kategori']);

        if ($regency && $regency !== 'all') {
            $wisataQuery->whereHas('lokasi', function ($query) use ($regency) {
                $query->whereRaw('LOWER(nama_kabupaten) LIKE ?', ['%' . strtolower($regency) . '%']);
            });
        }

        if ($budget && (int) $budget > 0) {
            $wisataQuery->where(function ($query) use ($budget) {
                $query->where('harga_wni_min', '<=', (int) $budget)
                    ->orWhereNull('harga_wni_min');
            });
        }

        if (!empty($amenities)) {
            $amenityMap = [
                'parking' => ['parkir', 'parking'],
                'wifi' => ['wifi'],
                'restroom' => ['toilet', 'restroom', 'kamar mandi'],
                'restaurant' => ['restoran', 'warung', 'makan'],
            ];

            $wisataQuery->whereHas('fasilitas', function ($query) use ($amenities, $amenityMap) {
                $query->where(function ($inner) use ($amenities, $amenityMap) {
                    foreach ($amenities as $amenity) {
                        if (isset($amenityMap[$amenity])) {
                            foreach ($amenityMap[$amenity] as $keyword) {
                                $inner->orWhereRaw('LOWER(nama_fasilitas) LIKE ?', ['%' . strtolower($keyword) . '%']);
                            }
                        }
                    }
                });
            });
        }

        if ($interest && $interest !== 'all') {
            $interestMap = [
                'nature' => ['nature', 'alam', 'hutan', 'gunung', 'danau', 'terasering', 'air terjun'],
                'culture' => ['culture', 'budaya', 'heritage', 'pura', 'candi', 'desa', 'tarian', 'sejarah'],
                'beach' => ['beach', 'pantai', 'coast', 'laut', 'pasir', 'selancar', 'snorkeling'],
                'culinary' => ['culinary', 'kuliner', 'food', 'makan', 'restoran', 'kopi'],
            ];

            $keywords = $interestMap[$interest] ?? [$interest];

            $wisataQuery->where(function ($query) use ($keywords) {
                $query->whereHas('kategori', function ($inner) use ($keywords) {
                    $inner->where(function ($q) use ($keywords) {
                        foreach ($keywords as $keyword) {
                            $q->orWhereRaw('LOWER(nama_kategori) LIKE ?', ['%' . strtolower($keyword) . '%']);
                        }
                    });
                })->orWhere(function ($inner) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $inner->orWhereRaw('LOWER(nama) LIKE ?', ['%' . strtolower($keyword) . '%']);
                    }
                })->orWhere(function ($inner) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $inner->orWhereRaw('LOWER(deskripsi) LIKE ?', ['%' . strtolower($keyword) . '%']);
                    }
                });
            });
        }

        $wisata = $wisataQuery->get();

        if ($wisata->isEmpty()) {
            return view('pages.user.recommendations.results', [
                'destinations' => collect(),
                'filterSummary' => $filterSummary,
            ]);
        }

        $wisataIds = $wisata->pluck('id');

        $penilaian = Penilaian::query()
            ->whereIn('wisata_id', $wisataIds)
            ->get(['wisata_id', 'kriteria_id', 'nilai']);

        if ($penilaian->isEmpty()) {
            return view('pages.user.recommendations.results', [
                'destinations' => collect(),
                'filterSummary' => $filterSummary,
            ]);
        }

        $kriteriaIds = $penilaian->pluck('kriteria_id')->unique()->values();

        $kriteria = Kriteria::query()
            ->whereIn('id', $kriteriaIds)
            ->get(['id', 'nama_kriteria', 'tipe']);

        $bobot = DB::table('bobot_kriteria')
            ->whereIn('kriteria_id', $kriteriaIds)
            ->get(['kriteria_id', 'bobot']);

        $payload = [
            'kriteria' => $kriteria->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama_kriteria' => $item->nama_kriteria,
                    'tipe' => $item->tipe,
                ];
            })->values()->all(),
            'penilaian' => $penilaian->map(function ($item) {
                return [
                    'wisata_id' => $item->wisata_id,
                    'kriteria_id' => $item->kriteria_id,
                    'nilai' => (float) $item->nilai,
                ];
            })->values()->all(),
            'bobot' => $bobot->map(function ($item) {
                return [
                    'kriteria_id' => $item->kriteria_id,
                    'bobot' => (float) $item->bobot,
                ];
            })->values()->all(),
            'filters' => [
                'regency' => $regency,
                'interest' => $interest,
                'budget' => $budget,
                'amenities' => $amenities,
            ],
        ];

        try {
            $response = Http::timeout(10)->post('http://127.0.0.1:5000/hitung-saw', $payload);
            
            if (!$response->successful()) {
                return view('pages.user.recommendations.results', [
                    'destinations' => collect(),
                    'filterSummary' => $filterSummary,
                ]);
            }

            $rankingRaw = $response->json();
            $wisataById = $wisata->keyBy('id');

            $destinations = collect($rankingRaw)
                ->map(function ($row) use ($wisataById) {
                    $wisataId = $row['wisata_id'] ?? null;
                    $item = $wisataId ? $wisataById->get($wisataId) : null;

                    if (!$item) {
                        return null;
                    }

                    $item->skor_akhir = (float) ($row['skor'] ?? 0);

                    return $item;
                })
                ->filter()
                ->sortByDesc('skor_akhir')
                ->values();

            $paginatedDestinations = $this->paginateRecommendations($destinations, $request);

            return view('pages.user.recommendations.results', [
                'destinations' => $paginatedDestinations->getCollection(),
                'destinationsPaginator' => $paginatedDestinations,
                'totalDestinations' => $destinations->count(),
                'perPage' => 12,
                'filterSummary' => $filterSummary,
            ]);
        } catch (\Throwable $e) {
            report($e);

            return view('pages.user.recommendations.results', [
                'destinations' => collect(),
                'filterSummary' => $filterSummary,
            ]);
        }
    }

    private function buildFilterSummary($regency, $interest, $budget, array $amenities): array
    {
        $regencyLabels = [
            'all' => 'Semua Kabupaten',
            'badung' => 'Badung',
            'gianyar' => 'Gianyar',
            'bangli' => 'Bangli',
            'buleleng' => 'Buleleng',
        ];

        $interestLabels = [
            'all' => 'Semua Kategori',
            'nature' => 'Alam',
            'culture' => 'Budaya',
            'beach' => 'Pantai',
            'culinary' => 'Kuliner',
        ];

        $amenityLabels = [
            'parking' => 'Area Parkir',
            'wifi' => 'Wifi Cepat',
            'restroom' => 'Toilet Bersih',
            'restaurant' => 'Restoran/Rumah Makan',
        ];

        $budgetValue = is_numeric($budget) ? (int) $budget : 0;

        return [
            'regency' => $regencyLabels[$regency ?: 'all'] ?? ucfirst((string) $regency),
            'interest' => $interestLabels[$interest ?: 'all'] ?? ucfirst((string) $interest),
            'budget' => $budgetValue > 0 ? 'Rp ' . number_format($budgetValue, 0, ',', '.') : 'Tidak dibatasi',
            'amenities' => collect($amenities)
                ->map(fn ($amenity) => $amenityLabels[$amenity] ?? ucfirst((string) $amenity))
                ->values()
                ->all(),
        ];
    }

    private function paginateRecommendations($destinations, Request $request, int $perPage = 12): LengthAwarePaginator
    {
        $total = $destinations->count();
        $lastPage = max(1, (int) ceil($total / $perPage));
        $page = min(max(1, (int) $request->query('page', 1)), $lastPage);

        return new LengthAwarePaginator(
            $destinations->slice(($page - 1) * $perPage, $perPage)->values(),
            $total,
            $perPage,
            $page,
            [
                'path' => $request->url(),
                'query' => collect($request->query())->except('page')->all(),
            ]
        );
    }
}
