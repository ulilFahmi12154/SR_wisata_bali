@extends('layouts.app')

@section('title', 'Itineraries')

@section('content')

<div style="margin-top:40px;">
    <p style="color:#0b5ed7; font-weight:700; letter-spacing:1px; font-size:12px;">ITINERARIES</p>

    <div class="hero-title">
        Build A <span class="blue">Day-by-Day</span> Bali Plan.
    </div>

    <p style="max-width:720px; color:#4f5b70;">
        Choose a travel rhythm that fits your style, from relaxed beach days to packed culture and culinary routes.
    </p>
</div>

<div class="grid">
    <div class="card">
        <h3>3-Day Essentials</h3>
        <p style="color:#5a6578;">A compact route for first-time visitors who want the best balance between nature and culture.</p>
    </div>

    <div class="card">
        <h3>7-Day Explorer</h3>
        <p style="color:#5a6578;">A richer schedule with more hidden gems, local activities, and slower transitions between regencies.</p>
    </div>
</div>

@endsection
