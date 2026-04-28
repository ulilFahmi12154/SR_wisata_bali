@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="grid">

    <!-- LEFT -->
    <div>
        <p style="color:#0b5ed7;">RECOMMENDATION ENGINE</p>

        <div class="hero-title">
            Craft Your <span class="blue">Perfect Bali</span> Escape.
        </div>

        <p>
            Our precision curation engine transforms your preferences into a tailored itinerary.
        </p>

        <img src="https://images.unsplash.com/photo-1604999333679-b86d54738315"
             style="width:100%; border-radius:16px; margin-top:20px;">
    </div>

    <!-- RIGHT FORM -->
    <div class="card">

        <h3>Where do you want to explore?</h3>
        <select style="width:100%; padding:10px; margin-top:10px;">
            <option>Select a Regency</option>
        </select>

        <h3 style="margin-top:20px;">Primary Interest</h3>
        <div class="flex" style="gap:10px;">
            <div class="chip active">Nature</div>
            <div class="chip">Culture</div>
            <div class="chip">Beach</div>
            <div class="chip">Culinary</div>
        </div>

        <h3 style="margin-top:20px;">Daily Budget</h3>
        <input type="range" style="width:100%;">

        <h3 style="margin-top:20px;">Essential Amenities</h3>

        <div>
            <label><input type="checkbox"> Parking Area</label><br>
            <label><input type="checkbox" checked> Wifi</label><br>
            <label><input type="checkbox"> Clean Restroom</label><br>
            <label><input type="checkbox"> Restaurant</label>
        </div>

        <button class="btn-primary" style="margin-top:20px;">
            Cari Rekomendasi →
        </button>

    </div>

</div>

@endsection