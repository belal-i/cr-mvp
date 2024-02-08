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
        Schema::table('apartments', function (Blueprint $table) {
            $table->foreignId('address_id');
            $table->dropColumn('street');
            $table->dropColumn('house_number');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
            $table->dropColumn('nearby_public_transit');
            $table->dropColumn('neighborhood');
            $table->dropColumn('nearby_points_of_interest');
            $table->dropColumn('parking_rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn('address_id');
            $table->string('street', 50)->nullable();
            $table->string('house_number', 40)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('city', 30)->nullable();
            $table->json('nearby_public_transit')->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->json('nearby_points_of_interest')->nullable();
            $table->float('parking_rating', 2, 1)->nullable();
        });
    }
};
