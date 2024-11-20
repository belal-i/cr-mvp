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
        Schema::table('images', function (Blueprint $table) {
            $table->enum('file_extension', [
                'jpg',
                'png',
                'gif',
                // TODO: TBC...
            ])->nullable()->change();
            $table->enum('image_type', [
                'LIVING',       //    0
                'BEDROOM',      //  100
                'KITCHEN',      //  200
                'BATHROOM',     //  300
                'BALCONY',      //  400
                'ENTRANCE',     //  500
                'HALLWAY',      //  600
                'LAYOUT',       //  700
                'VIEW',         //  800
                'PARKING',      //  900
                'STORAGE',      // 1000
                'NEIGHBORHOOD', // 1100
                'HOUSE_VIEW',   // 1200
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->enum('file_extension', [
                'jpg',
                'png',
                'gif',
                // TODO: TBC...
            ])->nullable(false)->change();
            $table->enum('image_type', [
                'LIVING',       //    0
                'BEDROOM',      //  100
                'KITCHEN',      //  200
                'BATHROOM',     //  300
                'BALCONY',      //  400
                'ENTRANCE',     //  500
                'HALLWAY',      //  600
                'LAYOUT',       //  700
                'VIEW',         //  800
                'PARKING',      //  900
                'STORAGE',      // 1000
                'NEIGHBORHOOD', // 1100
                'HOUSE_VIEW',   // 1200
            ])->nullable(false)->change();
        });
    }
};
