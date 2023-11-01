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
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('first_name', 20)->nullable()->change();
            $table->string('last_name', 30)->nullable()->change();
            $table->string('salutation', 10)->nullable()->change();
            $table->json('email')->nullable()->change();
            $table->json('phone')->nullable()->change();
            $table->string('street', 50)->nullable()->change();
            $table->string('house_number', 40)->nullable()->change();
            $table->string('zip_code', 10)->nullable()->change();
            $table->string('city', 50)->nullable()->change();
            // TODO: Check if this works with our normalized data.
            $table->date('last_contact_date')->nullable()->change();
            $table->time('last_contact_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('first_name', 20)->nullable(false)->change();
            $table->string('last_name', 30)->nullable(false)->change();
            $table->string('salutation', 10)->nullable(false)->change();
            $table->json('email')->nullable(false)->change();
            $table->json('phone')->nullable(false)->change();
            $table->string('street', 50)->nullable(false)->change();
            $table->string('house_number', 10)->nullable(false)->change();
            $table->string('zip_code', 10)->nullable(false)->change();
            $table->string('city', 50)->nullable(false)->change();
            // TODO: Check if this works with our normalized data.
            $table->date('last_contact_date')->nullable(false)->change();
            $table->time('last_contact_time')->nullable(false)->change();
        });
    }
};
