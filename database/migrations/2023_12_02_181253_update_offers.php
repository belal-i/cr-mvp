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
        Schema::table('offers', function (Blueprint $table) {
            $table->boolean('is_premium')->nullable();
            $table->boolean('utility_cost_included')->nullable();
            $table->boolean('electricity_cost_included')->nullable();
            $table->boolean('heating_cost_included')->nullable();
            $table->boolean('gas_cost_included')->nullable();
            $table->boolean('water_cost_included')->nullable();
            $table->boolean('internet_cost_included')->nullable();
            $table->boolean('cleaning_cost_included')->nullable();
            $table->float('utility_cost_amount', 5, 2)->nullable();
            $table->float('electricity_cost_amount', 5, 2)->nullable();
            $table->float('heating_cost_amount', 5, 2)->nullable();
            $table->float('gas_cost_amount', 5, 2)->nullable();
            $table->float('water_cost_amount', 5, 2)->nullable();
            $table->float('internet_cost_amount', 5, 2)->nullable();
            $table->float('cleaning_cost_amount', 5, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn([
                'is_premium',
                'utility_cost_included',
                'electricity_cost_included',
                'heating_cost_included',
                'gas_cost_included',
                'water_cost_included',
                'internet_cost_included',
                'cleaning_cost_included',
                'utility_cost_amount',
                'electricity_cost_amount',
                'heating_cost_amount',
                'gas_cost_amount',
                'water_cost_amount',
                'internet_cost_amount',
                'cleaning_cost_amount',
            ]);
        });
    }
};
