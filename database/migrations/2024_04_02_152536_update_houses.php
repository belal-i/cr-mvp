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
            $table->boolean('has_dryer')->nullable();
            $table->boolean('has_elevator')->nullable();
            $table->boolean('has_washing_machine')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('houses', function (Blueprint $table) {
            $table->dropColumn([
                'has_dryer',
                'has_elevator',
                'has_washing_machine',
            ]);
        });
    }
};
