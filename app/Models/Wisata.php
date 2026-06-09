<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wisata extends Model
{
    protected $table = 'wisata'; // Pastikan nama tabel sesuai migrasi

    protected $fillable = [
        'nama', 'kategori_id', 'lokasi_id', 'harga_wni_min', 'harga_wni_max',
        'harga_wna_min', 'harga_wna_max', 'rating', 'deskripsi', 
        'keterangan', 'jam_operasional', 'link', 'image', 'latitude', 'longitude'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function fasilitas(): BelongsToMany
    {
        return $this->belongsToMany(Fasilitas::class, 'wisata_fasilitas');
    }

    public function penilaian(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function wantToGos(): HasMany
    {
        return $this->hasMany(WantToGo::class);
    }

    public function wantedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'want_to_gos')->withTimestamps();
    }
}
