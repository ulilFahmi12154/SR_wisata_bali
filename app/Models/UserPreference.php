<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'preferred_region',
        'price_category',
        'budget_min',
        'budget_max',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
