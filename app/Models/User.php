<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'onboarding_completed', 'preferences_completed_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Cast attributes
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'onboarding_completed' => 'boolean',
            'preferences_completed_at' => 'datetime',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function preference(): HasOne
    {
        return $this->hasOne(UserPreference::class);
    }

    public function preferenceCategories(): HasMany
    {
        return $this->hasMany(UserPreferenceCategory::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function wantToGos(): HasMany
    {
        return $this->hasMany(WantToGo::class);
    }

    public function wantToGoDestinations(): BelongsToMany
    {
        return $this->belongsToMany(Wisata::class, 'want_to_gos')->withTimestamps();
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
