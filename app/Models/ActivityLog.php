<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = [
        'session_id', 'user_id', 'user_name', 'action_type',
        'action', 'icon', 'search_keyword', 'url', 'ip_address'
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}