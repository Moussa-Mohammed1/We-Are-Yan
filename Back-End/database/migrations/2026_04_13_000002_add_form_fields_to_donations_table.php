<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('donor_name')->nullable()->after('donor_id');
            $table->string('donor_email')->nullable()->after('donor_name');
            $table->text('message')->nullable()->after('method');
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['donor_name', 'donor_email', 'message']);
        });
    }
};
