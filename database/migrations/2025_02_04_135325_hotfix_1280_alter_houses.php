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
        Schema::table('houses', function (Blueprint $table) {
            $table->enum('energy_source', [
                'ACID_GAS',
                'BIO_ENERGY',
                'COMBINED_HEAT_AND_POWER_FOSSIL_FUELS',
                'COMBINED_HEAT_AND_POWER_PLANT',
                'COMBINED_HEAT_AND_POWER_RENEWABLE_ENERGY',
                'DISTRICT_HEATING',
                'ELECTRICITY',
                'ENVIRONMENTAL_THERMAL_ENERGY',
                'GAS',
                'GAS_HEATING',
                'HEAT_PUMP',
                'HEAT_SUPPLY',
                'LOCAL_HEATING',
                'NATURAL_GAS_LIGHT',
                'NO_INFORMATION',
                'OIL',
                'OIL_HEATING',
                'SELF_CONTAINED_CENTRAL_HEATING',
                'SOLAR_HEATING',
                'SOUR_GAS',
                'STEAM_DISTRICT_HEATING',
                'WOOD',
                'WOOD_PELLET_HEATING',
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->enum('energy_source', [
                'ACID_GAS',
                'BIO_ENERGY',
                'COMBINED_HEAT_AND_POWER_FOSSIL_FUELS',
                'COMBINED_HEAT_AND_POWER_PLANT',
                'COMBINED_HEAT_AND_POWER_RENEWABLE_ENERGY',
                'DISTRICT_HEATING',
                'ELECTRICITY',
                'ENVIRONMENTAL_THERMAL_ENERGY',
                'GAS',
                'GAS_HEATING',
                'HEAT_PUMP',
                'HEAT_SUPPLY',
                'LOCAL_HEATING',
                'NATURAL_GAS_LIGHT',
                'NO_INFORMATION',
                'OIL',
                'OIL_HEATING',
                'SOLAR_HEATING',
                'SOUR_GAS',
                'STEAM_DISTRICT_HEATING',
                'WOOD',
                'WOOD_PELLET_HEATING',
            ])->nullable()->change();
        });
    }
};
