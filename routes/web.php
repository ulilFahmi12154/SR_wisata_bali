<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekomendasiController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AnalyticsController;

/*
|--------------------------------------------------------------------------
| ROOT (LANDING PAGE PUBLIC)
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landingpage');


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::view('/about', 'pages.about')->name('about');
Route::view('/kebijakan-privasi', 'pages.privacy')->name('privacy');
Route::redirect('/privacy-policy', '/kebijakan-privasi');
Route::view('/syarat-ketentuan', 'pages.terms')->name('terms');
Route::redirect('/terms', '/syarat-ketentuan');
Route::redirect('/contact', '/#kontak')->name('contact');

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

    Route::get('/login', fn () =>
        view('pages.auth.user.login')
    )->name('login'); // → route name jadi 'user.login' ✅

    Route::post('/login', function () {

        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('user.home'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.'
        ])->onlyInput('email');

    })->name('login.process');


    Route::get('/register', fn () =>
        view('pages.auth.user.register')
    )->name('register');

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
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'user',
            ]);

            return redirect()
                ->route('user.login')
                ->with('success', 'Registrasi berhasil. Silakan login.');
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Registrasi gagal. Silakan coba lagi.');
        }
    })->name('register.process');


});


/*
|--------------------------------------------------------------------------
| USER AREA (PROTECTED)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->name('user.')->group(function () {

    Route::get('/home', fn () =>
        view('pages.user.home')
    )->name('home');

    Route::get('/destinasi', [RekomendasiController::class, 'index'])->name('destinations');

    Route::get('/destinations', fn () => redirect()->route('user.destinations'))->name('destinations.legacy');

    Route::get('/destinasi/{id}', [RekomendasiController::class, 'show'])->name('destinations.detail');

    Route::get('/destinations/{id}', fn ($id) => redirect()->route('user.destinations.detail', ['id' => $id]))->name('destinations.detail.legacy');

    Route::post('/rekomendasi', [RekomendasiController::class, 'process'])->name('recommendations.process');

    Route::get('/rekomendasi/hasil', [RekomendasiController::class, 'results'])->name('recommendations.results');

    Route::redirect('/recommendation', '/rekomendasi/hasil')->name('recommendation');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/login');

    /*
    |----------------------------------------------------------------------
    | ADMIN AUTH (GUEST ONLY)
    |----------------------------------------------------------------------
    */

    Route::middleware('guest')->group(function () {

        Route::get('/login', fn () =>
            view('pages.auth.admin.login')
        )->name('login');

        Route::post('/login', function () {
            $credentials = request()->only('email', 'password');

            if (Auth::attempt($credentials)) {
                request()->session()->regenerate();

                if (Auth::attempt(array_merge($credentials, ['role' => 'admin']))) {
                    request()->session()->regenerate();
                    return redirect()->route('admin.dashboard');
                }

                return back()->withErrors([
                    'email' => 'Kredensial salah atau akun ini tidak memiliki akses admin.'
                ])->onlyInput('email');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ])->onlyInput('email');

        })->name('login.process');

        Route::get('/register', fn () =>
            view('pages.auth.admin.register')
        )->name('register');

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
                'role' => 'admin', // Otomatis mendaftar sebagai admin
            ]);

            return redirect()
                ->route('admin.login')
                ->with('status', 'Akun admin berhasil dibuat. Silakan login.');
        })->name('register.process');

        // LUPA PASSWORD ADMIN (Opsional - Mengarah ke file forgot-password admin Anda)
        Route::get('/lupa-password', fn () => 
            view('pages.auth.admin.forgot-password')
        )->name('password.request');

        // Tambahkan rute ini untuk memproses kirim email link reset (POST)
        Route::post('/lupa-password', function () {
            $data = request()->validate([
                'email' => ['required', 'email', 'exists:users,email'],
            ], [
                'email.exists' => 'Email tidak terdaftar di sistem kami.'
            ]);

            // TODO: Logika pengiriman email reset token asli nanti di sini.
            // Sementara kita kembalikan status sukses simulasi dulu agar tidak error:
            return back()->with('status', 'Link reset password telah dikirim ke email Anda.');

        })->name('password.email');
    });


    /*
    |----------------------------------------------------------------------
    | ADMIN PROTECTED
    |----------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', 
            [App\Http\Controllers\Admin\DashboardController::class, 'index'
        ])->name('dashboard');

        // Users
        Route::resource('users', 
            UserController::class);

        // Destinations 
        Route::resource('destinations', 
            DestinationController::class);

        // Analytics
        Route::get('/analytics', 
            [AnalyticsController::class, 'index'])
        ->name('analytics');

        // Admin Logout
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
| USER LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('landingpage');
})->name('logout')->middleware('auth');
