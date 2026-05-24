<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            // Menambahkan kolom views dengan nilai bawaan 0 setelah kolom nama/id
            $table->integer('views')->default(0)->after('id'); 
        });
    }

    public function down(): void
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
};