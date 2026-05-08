<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| ROOT
|--------------------------------------------------------------------------
*/

Route::redirect('/', '/login');


/*
|--------------------------------------------------------------------------
| PUBLIC
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

    Route::get('/login', fn() => view('pages.auth.user.login'))->name('login');

    Route::post('/login', function () {

        $credentials = request()->only('email', 'password');

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.home');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    })->name('login.process');


    Route::get('/register', fn() => view('pages.auth.user.register'))->name('register');

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

    Route::get('/forgot-password', fn() => view('pages.auth.user.forgot-password'))
        ->name('password.request');

});


/*
|--------------------------------------------------------------------------
| USER AREA (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->name('user.')->group(function () {

    // PUBLIC-like but after login
    Route::get('/home', fn() => view('pages.user.home'))->name('home');

    Route::get('/destinations', fn() => view('pages.user.destinations.index'))->name('destinations');

    Route::get('/destinations/{id}', fn($id) =>
        view('pages.user.destinations.detail', compact('id'))
    )->name('destinations.detail');

    // 🔒 protected
    Route::get('/recommendation', fn() => view('pages.user.recommendation'))->name('recommendation');

    Route::get('/profile', fn() => view('pages.user.profile'))->name('profile');

});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ADMIN AUTH
    |--------------------------------------------------------------------------
    */

    Route::middleware('guest')->group(function () {

        Route::get('/login', fn() => view('pages.auth.admin.login'))->name('login');

        // 🔥 pakai auth yang sama
        Route::post('/login', function () {

            $credentials = request()->only('email', 'password');

            if (Auth::attempt($credentials)) {
                request()->session()->regenerate();

                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                }

                // kalau bukan admin → tolak
                Auth::logout();
                return back()->withErrors(['email' => 'Bukan akun admin']);
            }

            return back()->withErrors(['email' => 'Login gagal']);
        })->name('login.process');

        Route::get('/forgot-password', fn() => view('pages.auth.admin.forgot-password'))
            ->name('password.request');

    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN PROTECTED
    |--------------------------------------------------------------------------
    */

    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', fn() => view('pages.admin.dashboard'))->name('dashboard');

        Route::get('/users', fn() => view('pages.admin.users.index'))->name('users.index');

        Route::get('/users/{id}', fn($id) =>
            view('pages.admin.users.detail', compact('id'))
        )->name('users.detail');

        Route::get('/destinations', fn() => view('pages.admin.destinations.index'))->name('destinations.index');

        Route::get('/destinations/create', fn() => view('pages.admin.destinations.create'))->name('destinations.create');

        Route::get('/destinations/{id}/edit', fn($id) =>
            view('pages.admin.destinations.edit', compact('id'))
        )->name('destinations.edit');

        Route::get('/analytics', fn() => view('pages.admin.analytics'))->name('analytics');

    });

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| TEST
|--------------------------------------------------------------------------
*/

Route::get('/test-db', function () {
    return DB::select('SHOW TABLES');
});