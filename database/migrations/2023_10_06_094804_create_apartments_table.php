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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('source_id', 10);
            $table->string('street', 50);
            $table->string('house_number', 10);
            $table->string('zip_code', 10);
            $table->string('city', 30);
            $table->string('apartment_type', 20);
            $table->json('notes');
            $table->float('number_of_rooms', 3, 2);
            $table->smallInteger('size_sq_m');
            $table->boolean('is_furnished');
            $table->date('date_created');
            $table->string('account_manager', 5);
            $table->string('key_number', 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
