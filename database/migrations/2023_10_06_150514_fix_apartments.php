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
            $table->foreignId('contact_id')->nullable()->change();
            $table->string('street', 50)->nullable()->change();
            $table->string('house_number', 40)->nullable()->change();
            $table->string('zip_code', 10)->nullable()->change();
            $table->string('city', 30)->nullable()->change();
            $table->string('apartment_type', 20)->nullable()->change();
            $table->json('notes')->nullable()->change();
            $table->float('number_of_rooms', 5, 2)->nullable()->change();
            $table->smallInteger('size_sq_m')->nullable()->change();
            $table->boolean('is_furnished')->nullable()->change();
            $table->date('date_created')->nullable()->change();
            $table->string('account_manager', 5)->nullable()->change();
            $table->string('key_number', 30)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->foreignId('contact_id')->nullable(false)->change();
            $table->string('street', 50)->nullable(false)->change();
            $table->string('house_number', 10)->nullable(false)->change();
            $table->string('zip_code', 10)->nullable(false)->change();
            $table->string('city', 30)->nullable(false)->change();
            $table->string('apartment_type', 20)->nullable(false)->change();
            $table->json('notes')->nullable(false)->change();
            $table->float('number_of_rooms', 3, 2)->nullable(false)->change();
            $table->smallInteger('size_sq_m')->nullable(false)->change();
            $table->boolean('is_furnished')->nullable(false)->change();
            $table->date('date_created')->nullable(false)->change();
            $table->string('account_manager', 5)->nullable(false)->change();
            $table->string('key_number', 5)->nullable(false)->change();
        });
    }
};
