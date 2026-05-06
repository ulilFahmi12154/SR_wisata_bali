<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['nama_kategori']; // Sesuaikan nama kolom di migrasimu
    public $timestamps = false; // Jika di migrasi tidak pakai $table->timestamps()
}
