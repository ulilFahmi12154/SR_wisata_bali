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
        $user?->loadMissing(['preference', 'preferenceCategories.category']);

        return view('pages.user.home', [
            'user' => $user,
            'preferenceDestinations' => $recommendationService->recommendByPreference($user, 6),
            'activityDestinations' => $recommendationService->recommendByActivity($user, 6),
            'wantedWisataIds' => $user
                ? $user->wantToGos()->pluck('wisata_id')->all()
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
