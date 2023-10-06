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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 20);
            $table->string('last_name', 30);
            $table->string('salutation', 10);
            $table->json('email');
            $table->json('phone');
            $table->string('street', 50);
            $table->string('house_number', 10);
            $table->string('zip_code', 10);
            $table->string('city', 50);
            // TODO: Check if this works with our normalized data.
            $table->date('last_contact_date');
            $table->time('last_contact_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
