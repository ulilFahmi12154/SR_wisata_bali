<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $fillable = ['nama_fasilitas'];
    public $timestamps = false;

    public function wisata(): BelongsToMany
    {
        return $this->belongsToMany(Wisata::class, 'wisata_fasilitas');
    }
}
