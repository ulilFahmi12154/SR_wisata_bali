<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('user_name'); // Menyimpan nama user yang melakukan aksi
            $table->string('action');    // Contoh: 'mencari "Pantai Melasti"' atau 'baru saja login'
            $table->string('icon')->default('view'); // Nilai: search, login, register, view
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};