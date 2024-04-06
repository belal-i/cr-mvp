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
            $table->boolean('has_balcony')->nullable();
            $table->boolean('has_dish_washer')->nullable();
            $table->boolean('has_dryer')->nullable();
            $table->boolean('has_internet')->nullable();
            $table->boolean('has_parking_space')->nullable();
            $table->boolean('has_washing_machine')->nullable();
            $table->boolean('pets_ok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'has_balcony',
                'has_dish_washer',
                'has_dryer',
                'has_internet',
                'has_parking_space',
                'has_washing_machine',
                'pets_ok',
            ]);
        });
    }
};
