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
            $table->dropColumn('address_id');
            $table->dropColumn('house_description');
            $table->dropColumn('house_type');
            $table->dropColumn('house_character');
            $table->dropColumn('number_of_stories');
            $table->dropColumn('year_of_construction');
            $table->dropColumn('year_of_last_renovation');
            $table->dropColumn('energy_rating_type');
            $table->dropColumn('energy_source');
            $table->dropColumn('energy_usage_value');
            $table->dropColumn('energy_consumption_contains_warm_water');
            $table->dropColumn('energy_certificate_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function(Blueprint $table) {
            $table->foreignId('address_id');
            $table->string('house_description', 100)->nullable();
            $table->string('house_type', 100)->nullable();
            $table->string('house_character', 100)->nullable();
            $table->tinyInteger('number_of_stories')->nullable();
            // This one cannot be year, because we have some values
            // before 1900.
            $table->smallInteger('year_of_construction')->nullable();
            $table->year('year_of_last_renovation')->nullable();
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
};
