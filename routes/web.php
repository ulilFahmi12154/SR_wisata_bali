<?php

use App\Http\Controllers\RekomendasiController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

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
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');


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


    Route::get('/forgot-password', fn () =>
        view('pages.auth.user.forgot-password')
    )->name('password.request');

    Route::post('/forgot-password', function () {

        // TODO: kirim link reset password

        return back()->with('status', 'Link reset password telah dikirim.');

    })->name('password.email');

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

    Route::get('/destinations', [RekomendasiController::class, 'index'])->name('destinations');

    Route::get('/destinations/{id}', [RekomendasiController::class, 'show'])->name('destinations.detail');

    Route::get('/recommendation', fn () =>
        view('pages.user.recommendation')
    )->name('recommendation');

    Route::get('/profile', fn () =>
        view('pages.user.profile')
    )->name('profile');

    Route::match(['post', 'patch'], '/profile', function () {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.string' => 'Nama lengkap harus berupa teks.',
            'name.max' => 'Nama lengkap maksimal :max karakter.',
        ]);

        $user = request()->user();
        $user->forceFill([
            'name' => trim($data['name']),
        ])->save();

        return back()->with('status', 'Profil berhasil diperbarui.');

    })->name('profile.update');

});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

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

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                Auth::logout();
                request()->session()->invalidate();
                request()->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'Akun ini tidak memiliki akses admin.'
                ])->onlyInput('email');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.'
            ])->onlyInput('email');

        })->name('login.process');

    });


    /*
    |----------------------------------------------------------------------
    | ADMIN PROTECTED
    |----------------------------------------------------------------------
    */

    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', fn () =>
            view('pages.admin.dashboard')
        )->name('dashboard');

        // Users
        Route::get('/users', fn () =>
            view('pages.admin.users.index')
        )->name('users.index');

        Route::get('/users/{id}', fn ($id) =>
            view('pages.admin.users.detail', compact('id'))
        )->name('users.detail');

        // Destinations — /create WAJIB sebelum /{id}
        Route::get('/destinations', fn () =>
            view('pages.admin.destinations.index')
        )->name('destinations.index');

        Route::get('/destinations/create', fn () =>
            view('pages.admin.destinations.create')
        )->name('destinations.create');

        Route::post('/destinations', function () {

            // TODO: simpan destination

            return redirect()->route('admin.destinations.index')
                ->with('status', 'Destination berhasil ditambahkan.');

        })->name('destinations.store');

        Route::get('/destinations/{id}/edit', fn ($id) =>
            view('pages.admin.destinations.edit', compact('id'))
        )->name('destinations.edit');

        Route::put('/destinations/{id}', function ($id) {

            // TODO: update destination

            return redirect()->route('admin.destinations.index')
                ->with('status', 'Destination berhasil diupdate.');

        })->name('destinations.update');

        Route::delete('/destinations/{id}', function ($id) {

            // TODO: hapus destination

            return redirect()->route('admin.destinations.index')
                ->with('status', 'Destination berhasil dihapus.');

        })->name('destinations.destroy');

        // Analytics
        Route::get('/analytics', fn () =>
            view('pages.admin.analytics')
        )->name('analytics');

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

    return redirect()->route('user.login');
})->name('logout')->middleware('auth');
