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
            $table->string('nama', 250); // Dinaikkan sedikit panjangnya
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasi')->cascadeOnDelete();

            $table->integer('harga_wni_min')->nullable();
            $table->integer('harga_wni_max')->nullable();
            $table->integer('harga_wna_min')->nullable();
            $table->integer('harga_wna_max')->nullable();

            $table->decimal('rating', 3, 2)->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('keterangan')->nullable(); // Tambahkan ini
            $table->string('jam_operasional')->nullable(); // Tambahkan ini
            $table->string('link')->nullable(); // Untuk link maps
            $table->string('image')->nullable(); // Tambahkan ini untuk image path

            // Gunakan decimal untuk presisi koordinat
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->timestamps(); // Bagus untuk tracking data baru
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
