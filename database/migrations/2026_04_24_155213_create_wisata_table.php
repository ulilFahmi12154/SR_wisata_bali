<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();

            $table->string('nama', 150);

            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasi')->cascadeOnDelete();

            $table->integer('harga_wni_min')->nullable();
            $table->integer('harga_wni_max')->nullable();
            $table->integer('harga_wna_min')->nullable();
            $table->integer('harga_wna_max')->nullable();

            $table->decimal('rating', 3, 2)->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('link')->nullable();

            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisata');
    }
};
