<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            if (!Schema::hasColumn('devices', 'status')) {
                $table->string('status')->default('Offline')->after('topik');
            }

            if (!Schema::hasColumn('devices', 'last_seen')) {
                $table->timestamp('last_seen')->nullable()->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            if (Schema::hasColumn('devices', 'last_seen')) {
                $table->dropColumn('last_seen');
            }

            if (Schema::hasColumn('devices', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};