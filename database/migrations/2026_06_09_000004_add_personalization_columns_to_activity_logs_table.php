<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->unsignedSmallInteger('weight')->default(1)->after('icon');
            $table->json('metadata')->nullable()->after('weight');

            $table->index(['user_id', 'wisata_id', 'action_type']);
        });
    }

    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'wisata_id', 'action_type']);
            $table->dropColumn(['weight', 'metadata']);
        });
    }
};
