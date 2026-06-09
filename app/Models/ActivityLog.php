<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = [
        'session_id', 'user_id', 'wisata_id', 'user_name', 'action_type',
        'action', 'icon', 'weight', 'metadata', 'search_keyword', 'url', 'ip_address'
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function wisata()
    {
        return $this->belongsTo(Wisata::class);
    }
}
