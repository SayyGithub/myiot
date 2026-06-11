<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE sensors MODIFY data VARCHAR(255)");

        Schema::table('sensors', function (Blueprint $table) {
            if (!Schema::hasColumn('sensors', 'topik')) {
                $table->string('topik')->nullable()->after('data');
            }
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE sensors MODIFY data INT");

        Schema::table('sensors', function (Blueprint $table) {
            if (Schema::hasColumn('sensors', 'topik')) {
                $table->dropColumn('topik');
            }
        });
    }
};