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
            $table->enum('file_type', [
                'jpg',
                'png',
                'gif',
                // TODO: TBC...
            ]);
            $table->enum('image_type', [
                'LIVING',
                'BEDROOM',
                'KITCHEN',
                'BATHROOM',
                'ENTRANCE',
                'HALLWAY',
                'LAYOUT',
                'NEIGHBORHOOD',
                'HOUSE_VIEW',
            ]);
            $table->tinyInteger('sort_order')->nullable();
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
