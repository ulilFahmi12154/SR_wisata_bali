<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PreferenceController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\WantToGoController;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Middleware\EnsureAdmin;
use App\Helpers\ActivityHelper;

/*
|--------------------------------------------------------------------------
| ROOT & PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');

Route::view('/about', 'pages.about')->name('about');
Route::view('/kebijakan-privasi', 'pages.privacy')->name('privacy');
Route::redirect('/privacy-policy', '/kebijakan-privasi');
Route::view('/syarat-ketentuan', 'pages.terms')->name('terms');
Route::redirect('/terms', '/syarat-ketentuan');
Route::redirect('/contact', '/#kontak')->name('contact');

/*
|--------------------------------------------------------------------------
| UTILITY ROUTES FOR ADMIN LOGIN PORTAL
|--------------------------------------------------------------------------
*/
Route::view('/admin/help', 'pages.auth.admin.help')->name('admin.help');
Route::view('/admin/privacy-policy', 'pages.auth.admin.privacy')->name('privacy.policy');
Route::view('/admin/support', 'pages.auth.admin.support')->name('admin.support');

/*
|--------------------------------------------------------------------------
| PASSWORD RESET (PUBLIC)
|--------------------------------------------------------------------------
*/
Route::get('/lupa-password', [ForgotPasswordController::class, 'create'])->name('password.request');
Route::post('/lupa-password', [ForgotPasswordController::class, 'store'])->name('password.email');
Route::get('/forgot-password', fn () => redirect()->route('password.request'));
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');

/*
|--------------------------------------------------------------------------
| USER AUTH (GUEST ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->name('user.')->group(function () {
    Route::get('/login', fn () => view('pages.auth.user.login'))->name('login');

    Route::post('/login', function () {
        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            $user = Auth::user();

            ActivityHelper::log('login', "User {$user->name} login", 'login');

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->intended(route('user.home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');
    })->name('login.process');

    Route::get('/register', fn () => view('pages.auth.user.register'))->name('register');

    Route::post('/register', function () {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', "regex:/^[A-Za-z\s]+$/"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ], [
            'required' => ':attribute wajib diisi.',
            'email' => ':attribute tidak valid.',
            'unique' => ':attribute sudah terdaftar.',
            'min' => ':attribute minimal :min karakter.',
            'confirmed' => 'Konfirmasi password tidak cocok.',
            'regex' => ':attribute hanya boleh berisi huruf dan spasi.',
            'accepted' => ':attribute harus disetujui.',
            'terms.accepted' => 'Anda harus menyetujui Syarat & Ketentuan.',
        ], [
            'name' => 'Nama lengkap',
            'email' => 'Alamat email',
            'password' => 'Password',
            'password_confirmation' => 'Konfirmasi password',
            'terms' => 'Syarat & Ketentuan',
        ]);

        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
            ]);

            Auth::login($user);
            request()->session()->regenerate();

            return redirect()
                ->route('preferences.create')
                ->with('status', 'Registrasi berhasil. Silakan isi personalisasi awal.');
        } catch (\Throwable $e) {
            report($e);
            return back()
                ->withInput()
                ->with('error', 'Registrasi gagal. Silakan coba lagi.');
        }
    })->name('register.process');
});

/*
|--------------------------------------------------------------------------
| USER AREA (AUTHENTICATED)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/preferences', [PreferenceController::class, 'create'])->name('preferences.create');
    Route::post('/preferences', [PreferenceController::class, 'store'])->name('preferences.store');
    Route::get('/profile/preferences/edit', [PreferenceController::class, 'edit'])->name('preferences.edit');
    Route::patch('/profile/preferences', [PreferenceController::class, 'update'])->name('preferences.update');
    Route::get('/want-to-go', [WantToGoController::class, 'index'])->name('want-to-go.index');
    Route::post('/destinations/{destination}/want-to-go', [WantToGoController::class, 'toggle'])->name('destinations.want-to-go.toggle');
});

Route::middleware('auth')->name('user.')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/destinasi', [RekomendasiController::class, 'index'])->name('destinations');
    Route::get('/destinations', fn () => redirect()->route('user.destinations'))->name('destinations.legacy');
    Route::get('/destinasi/{id}', [RekomendasiController::class, 'show'])->name('destinations.detail');
    Route::get('/destinations/{id}', fn ($id) => redirect()->route('user.destinations.detail', ['id' => $id]))->name('destinations.detail.legacy');

    Route::get('/rekomendasi/eksplorasi', [HomeController::class, 'explore'])->name('recommendations.explore');
    Route::post('/rekomendasi', [RekomendasiController::class, 'process'])->name('recommendations.process');
    Route::get('/rekomendasi/hasil', [RekomendasiController::class, 'results'])->name('recommendations.results');
    Route::redirect('/recommendation', '/rekomendasi/hasil')->name('recommendation');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Logout user (gunakan route name 'user.logout' di view)
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('landingpage');
    })->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/login');

    Route::middleware('guest')->group(function () {
        Route::get('/login', fn () => view('pages.auth.admin.login'))->name('login');

        Route::post('/login', function () {
            $credentials = request()->only('email', 'password');

            if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
                request()->session()->regenerate();
                $user = Auth::user();
                ActivityHelper::log('login', "Admin {$user->name} login", 'login');
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors([
                'email' => 'Kredensial salah atau akun ini tidak memiliki akses admin.'
            ])->onlyInput('email');
        })->name('login.process');

        Route::get('/register', fn () => view('pages.auth.admin.register'))->name('register');

        Route::post('/register', function () {
            $data = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'admin',
            ]);

            return redirect()
                ->route('admin.login')
                ->with('status', 'Akun admin berhasil dibuat. Silakan login.');
        })->name('register.process');

        Route::get('/lupa-password', fn () => view('pages.auth.admin.forgot-password'))->name('password.request');
        Route::post('/lupa-password', function () {
            request()->validate([
                'email' => ['required', 'email', 'exists:users,email'],
            ], ['email.exists' => 'Email tidak terdaftar di sistem kami.']);
            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');
        })->name('password.email');
    });

    Route::middleware(['auth', EnsureAdmin::class])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('destinations', DestinationController::class);
        Route::get('/analytics', [AnalyticsController::class, 'index'])->name('analytics');
        Route::get('/analytics/category-details', [AnalyticsController::class, 'categoryDetails'])->name('analytics.category-details');

        // Logout admin
        Route::post('/logout', function () {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return redirect()->route('admin.login');
        })->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| API ENDPOINTS (tanpa CSRF) untuk dashboard admin
|--------------------------------------------------------------------------
| Menggunakan middleware 'api' agar tidak terkena CSRF protection.
| Jika ingin tetap menggunakan session, bisa ditambahkan 'web' tetapi harus
| menyertakan token CSRF pada setiap fetch. Disarankan menggunakan 'api'.
|--------------------------------------------------------------------------
*/
Route::prefix('api')->middleware('api')->group(function () {
    Route::get('/daily-visits', function () {
        $data = ActivityLog::where('action_type', 'visit')
            ->where('created_at', '>=', now()->subDays(6)->startOfDay()) // 7 hari termasuk hari ini
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Isi tanggal yang kosong dengan 0
        $labels = [];
        $values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('D'); // atau 'd M'
            $found = $data->firstWhere('date', $date);
            $values[] = $found ? $found->total : 0;
        }
        
        return response()->json([
            'labels' => $labels,
            'data' => $values
        ]);
    });

    Route::get('/daily-logins', function () {
        $data = ActivityLog::where('action_type', 'login')
            ->whereDate('created_at', '>=', now()->subDays(6))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(DISTINCT user_id) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $labels = [];
        $values = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('D'); // Sat, Sun, Mon, ...
            $found = $data->firstWhere('date', $date);
            $values[] = $found ? $found->total : 0;
        }

        return response()->json(['labels' => $labels, 'data' => $values]);
    });

    Route::get('/avg-session-duration', function () {
        $sessions = ActivityLog::select('session_id', DB::raw('MIN(created_at) as start'), DB::raw('MAX(created_at) as end'))
            ->groupBy('session_id')
            ->get();
        $avgDuration = $sessions->avg(fn($s) => strtotime($s->end) - strtotime($s->start));
        return response()->json(['average_seconds' => round($avgDuration)]);
    });

    Route::get('/total-visits', function () {
        $total = ActivityLog::where('action_type', 'visit')->count();
        return response()->json(['total' => $total]);
    });

    Route::get('/avg-daily-visits', function () {
        $dailyAvg = ActivityLog::where('action_type', 'visit')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->get()
            ->avg('total');
        return response()->json(['avg_daily_visits' => round($dailyAvg, 2)]);
    });

    Route::get('/avg-search-per-day', function () {
        $avg = ActivityLog::where('action_type', 'search')
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->get()
            ->avg('total');
        return response()->json(['avg_search_per_day' => round($avg, 2)]);
    });
});

/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE (404)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return view('errors.404');
});

Route::get('/test-log', function () {
    \App\Helpers\ActivityHelper::log('search', 'Test pencarian dari route', 'search', 'test');
    return 'Cek database, seharusnya ada baris baru dengan action_type=search';
});
