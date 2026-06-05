<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('wisata_id')->nullable()->after('user_id');
            $table->foreign('wisata_id')->references('id')->on('wisata')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropForeign(['wisata_id']);
            $table->dropColumn('wisata_id');
        });
    }
};