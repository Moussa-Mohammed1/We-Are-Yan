<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_account_email')->nullable()->after('city');
            $table->string('stripe_payment_link')->nullable()->after('stripe_account_email');
            $table->string('rib_account_holder')->nullable()->after('stripe_payment_link');
            $table->string('rib_bank_name')->nullable()->after('rib_account_holder');
            $table->string('rib_number')->nullable()->after('rib_bank_name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_account_email',
                'stripe_payment_link',
                'rib_account_holder',
                'rib_bank_name',
                'rib_number',
            ]);
        });
    }
};
