<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('id');
            $table->unsignedBigInteger('user_id')->nullable()->after('session_id');
            $table->string('action_type')->after('action'); // visit, search, login
            $table->string('search_keyword')->nullable()->after('action_type');
            $table->string('url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            
            // Index untuk mempercepat query
            $table->index('session_id');
            $table->index('action_type');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropColumn([
                'session_id', 'user_id', 'action_type',
                'search_keyword', 'url', 'ip_address'
            ]);
        });
    }
};