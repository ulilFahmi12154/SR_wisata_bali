<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('activity_logs') && ! $this->hasIndexOnColumns('activity_logs', ['wisata_id', 'action_type'])) {
            Schema::table('activity_logs', function (Blueprint $table) {
                $table->index(['wisata_id', 'action_type'], 'activity_logs_wisata_id_action_type_index');
            });
        }

        if (Schema::hasTable('want_to_gos') && ! $this->hasIndexOnColumns('want_to_gos', ['wisata_id'])) {
            Schema::table('want_to_gos', function (Blueprint $table) {
                $table->index('wisata_id', 'want_to_gos_wisata_id_index');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('activity_logs') && $this->hasIndexNamed('activity_logs', 'activity_logs_wisata_id_action_type_index')) {
            Schema::table('activity_logs', function (Blueprint $table) {
                $table->dropIndex('activity_logs_wisata_id_action_type_index');
            });
        }

        if (Schema::hasTable('want_to_gos') && $this->hasIndexNamed('want_to_gos', 'want_to_gos_wisata_id_index')) {
            Schema::table('want_to_gos', function (Blueprint $table) {
                $table->dropIndex('want_to_gos_wisata_id_index');
            });
        }
    }

    private function hasIndexNamed(string $table, string $name): bool
    {
        return collect(Schema::getIndexes($table))
            ->contains(fn (array $index) => ($index['name'] ?? null) === $name);
    }

    private function hasIndexOnColumns(string $table, array $columns): bool
    {
        return collect(Schema::getIndexes($table))
            ->contains(fn (array $index) => ($index['columns'] ?? []) === $columns);
    }
};
