<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('want_to_gos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('wisata_id')->constrained('wisata')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'wisata_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('want_to_gos');
    }
};
