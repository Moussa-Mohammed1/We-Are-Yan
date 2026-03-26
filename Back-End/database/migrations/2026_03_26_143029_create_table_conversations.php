<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donation_id')
                ->unique()
                ->constrained('donations')
                ->onDelete('cascade');

            $table->foreignId('donor_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('beneficiary_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};