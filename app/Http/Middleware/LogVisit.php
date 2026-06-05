<?php

namespace App\Http\Middleware;

use Closure;
use App\Helpers\ActivityHelper;

class LogVisit
{
    public function handle($request, Closure $next)
    {
        // Abaikan request AJAX, asset, atau route tertentu
        dd('Middleware LogVisit terpanggil');
        if (!$request->ajax() && !$request->is('_debugbar/*') && !$request->is('admin/*/api/*')) {
            ActivityHelper::log('visit', 'Mengunjungi ' . $request->path(), 'eye');
        }
        return $next($request);
    }
}