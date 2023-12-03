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
            $table->string('title', 500)->nullable();
            $table->json('specials')->nullable();
            $table->json('nearby_public_transit')->nullable();
            $table->string('neighborhood', 50)->nullable();
            $table->string('house_description', 100)->nullable();
            $table->string('house_type', 100)->nullable();
            $table->string('house_character', 100)->nullable();
            $table->tinyInteger('number_of_stories')->nullable();
            // This one cannot be year, because we have some values
            // before 1900.
            $table->smallInteger('year_of_construction')->nullable();
            $table->year('year_of_last_renovation')->nullable();
            $table->float('rating', 2, 1)->nullable();
            $table->tinyInteger('story')->nullable();
            $table->string('view', 100)->nullable();
            $table->string('flooring', 20)->nullable();
            $table->string('flooring_description', 20)->nullable();
            $table->string('flooring_material', 20)->nullable();
            $table->string('living_room_description', 50)->nullable();
            $table->string('living_room_type', 50)->nullable();
            $table->json('living_room_contents')->nullable();
            $table->json('furnishing_description')->nullable();
            $table->json('furnishing_style')->nullable();
            $table->json('nearby_points_of_interest')->nullable();
            $table->float('parking_rating', 2, 1)->nullable();
            // TODO: Not sure if these are all possible values, but it looks like it.
            // Probably have to release it like this. If ever something else comes,
            // we'll get a bug, but then we can quickly fix it.
            $table->enum('energy_rating_type', [
                'ENERGY_CONSUMPTION',
                'ENERGY_REQUIRED',
                'NO_INFORMATION',
            ])->nullable();
            $table->enum('energy_source', [
                'ACID_GAS',
                'BIO_ENERGY',
                'COMBINED_HEAT_AND_POWER_FOSSIL_FUELS',
                'COMBINED_HEAT_AND_POWER_RENEWABLE_ENERGY',
                'DISTRICT_HEATING',
                'ELECTRICITY',
                'GAS',
                'GAS_HEATING',
                'HEAT_PUMP',
                'HEAT_SUPPLY',
                'LOCAL_HEATING',
                'NO_INFORMATION',
                'OIL',
                'OIL_HEATING',
                'SOLAR_HEATING',
                'SOUR_GAS',
                'STEAM_DISTRICT_HEATING',
                'WOOD',
                'WOOD_PELLET_HEATING',
            ])->nullable();
            $table->float('energy_usage_value', 4, 1)->nullable();
            $table->boolean('energy_consumption_contains_warm_water')->nullable();
            $table->date('energy_certificate_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'title',
                'specials',
                'nearby_public_transit',
                'neighborhood',
                'house_description',
                'house_type',
                'house_character',
                'number_of_stories',
                'year_of_construction',
                'year_of_last_renovation',
                'rating',
                'story',
                'view',
                'flooring',
                'flooring_description',
                'flooring_material',
                'living_room_description',
                'living_room_type',
                'living_room_contents',
                'furnishing_description',
                'furnishing_style',
                'nearby_points_of_interest',
                'parking_rating',
                'energy_rating_type',
                'energy_source',
                'energy_usage_value',
                'energy_consumption_contains_warm_water',
                'energy_certificate_date',
            ]);
        });
    }
};
