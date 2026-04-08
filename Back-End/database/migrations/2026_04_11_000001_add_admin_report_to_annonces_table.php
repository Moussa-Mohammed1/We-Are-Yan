<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('annonces', 'rejection_reason') && ! Schema::hasColumn('annonces', 'raport')) {
            Schema::table('annonces', function (Blueprint $table) {
                $table->renameColumn('rejection_reason', 'raport');
            });
        }

        if (! Schema::hasColumn('annonces', 'reviewed_at')) {
            Schema::table('annonces', function (Blueprint $table) {
                $table->timestamp('reviewed_at')->nullable()->after('raport');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('annonces', 'reviewed_at')) {
            Schema::table('annonces', function (Blueprint $table) {
                $table->dropColumn('reviewed_at');
            });
        }

        if (Schema::hasColumn('annonces', 'raport') && ! Schema::hasColumn('annonces', 'rejection_reason')) {
            Schema::table('annonces', function (Blueprint $table) {
                $table->renameColumn('raport', 'rejection_reason');
            });
        }
    }
};
