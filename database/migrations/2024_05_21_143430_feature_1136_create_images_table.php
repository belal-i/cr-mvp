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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')
                  ->nullable()
                  ->constrained();
            $table->foreignId('house_id')
                  ->nullable()
                  ->constrained();
            $table->foreignId('address_id')
                  ->nullable()
                  ->constrained();
            // TODO: Do we even need a filepath? We can just name the
            // images by their ID, if we also know the file type.
            // $table->string('filepath', 50);
            $table->enum('file_extension', [
                'jpg',
                'png',
                'gif',
                // TODO: TBC...
            ]);
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
            ]);
            $table->smallInteger('sort_order')->default(900);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
