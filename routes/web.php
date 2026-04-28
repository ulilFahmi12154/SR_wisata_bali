<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/destinations');

Route::view('/curations', 'home')->name('curations');
Route::view('/destinations', 'pages.destinations')->name('destinations');
Route::view('/itineraries', 'pages.itineraries')->name('itineraries');
Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');

Route::get('/test-db', function () {
    return DB::select('SHOW TABLES');
});

