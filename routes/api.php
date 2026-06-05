<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/daily-visits', function () {
    $data = ActivityLog::where('action_type', 'visit')
        ->whereDate('created_at', '>=', now()->subDays(7))
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as total'))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    return response()->json($data);
});

Route::get('/daily-logins', function () {
    $data = ActivityLog::where('action_type', 'login')
        ->whereDate('created_at', '>=', now()->subDays(7))
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(DISTINCT user_id) as total'))
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    return response()->json($data);
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