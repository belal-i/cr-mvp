<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('source_id', 10);
            $table->string('street', 50)->nullable();
            $table->string('house_number', 40)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('city', 50)->nullable();
            $table->json('nearby_public_transit')->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->json('nearby_points_of_interest')->nullable();
            $table->float('parking_rating', 2, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
