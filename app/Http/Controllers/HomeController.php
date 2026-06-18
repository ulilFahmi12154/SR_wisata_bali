<?php

namespace App\Http\Controllers;

use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request, RecommendationService $recommendationService): View
    {
        $user = $request->user();
        $user?->loadMissing([
            'preference:id,user_id,preferred_region,price_category,budget_min,budget_max',
            'preferenceCategories:id,user_id,category_id,weight',
            'preferenceCategories.category:id,nama_kategori',
        ]);

        $preferenceDestinations = $recommendationService->recommendHomeByPreference($user, 6);
        $activityDestinations = $recommendationService->recommendHomeByActivity($user, 6);
        $homeWisataIds = $preferenceDestinations
            ->pluck('id')
            ->merge($activityDestinations->pluck('id'))
            ->unique()
            ->values();

        return view('pages.user.home', [
            'user' => $user,
            'preferenceDestinations' => $preferenceDestinations,
            'activityDestinations' => $activityDestinations,
            'wantedWisataIds' => $user && $homeWisataIds->isNotEmpty()
                ? $user->wantToGos()->whereIn('wisata_id', $homeWisataIds)->pluck('wisata_id')->all()
                : [],
        ]);
    }

    public function explore(Request $request): View
    {
        $user = $request->user();
        $user?->loadMissing(['preference', 'preferenceCategories.category']);

        return view('pages.user.recommendations.explore', [
            'user' => $user,
        ]);
    }
}
