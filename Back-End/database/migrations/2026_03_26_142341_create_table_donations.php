<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('annonce_id')
                ->constrained('annonces')
                ->onDelete('cascade');
            $table->foreignId('donor_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table->string('type');
            $table->string('amount_or_qty');
            $table->string('method')->nullable();
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};