<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/preferensi');

Route::view('/preferensi', 'pages.preferences')->name('preferences');
Route::redirect('/curations', '/preferensi');
Route::view('/destinations', 'pages.destinations')->name('destinations');
Route::view('/destinations/tanah-lot', 'pages.destination-detail')->name('destination-detail');
Route::view('/itineraries', 'pages.itineraries')->name('itineraries');
Route::view('/about', 'pages.about')->name('about');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::view('/contact', 'pages.contact')->name('contact');

Route::get('/test-db', function () {
    return DB::select('SHOW TABLES');
});
