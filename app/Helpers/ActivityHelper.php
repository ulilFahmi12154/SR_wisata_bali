<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ActivityHelper
{
    public static function log($actionType, $actionText, $icon = 'view', $keyword = null, $wisataId = null)
    {
        $user = Auth::user();
        
        ActivityLog::create([
            'session_id'     => Session::getId(),
            'user_id'        => $user?->id,
            'wisata_id'      => $wisataId,
            'user_name'      => $user?->name ?? 'Guest', 
            'action_type'    => $actionType,
            'action'         => $actionText,
            'icon'           => $icon,
            'search_keyword' => $keyword,
            'url'            => request()->fullUrl(),
            'ip_address'     => request()->ip(),
            'created_at'     => now(),
        ]);
    }
}
