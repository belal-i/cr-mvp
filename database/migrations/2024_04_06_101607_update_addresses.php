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
        Schema::table('addresses', function (Blueprint $table) {
            $table->mediumInteger('distance_from_city_center_m')->nullable();
            $table->enum(
                'compass_direction_from_city_center',
                ['N', 'NE', 'E', 'SE', 'S', 'SW', 'W', 'NW']
            )->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->dropColumn([
                'distance_from_city_center_m',
                'compass_direction_from_city_center',
            ]);
        });
    }
};
