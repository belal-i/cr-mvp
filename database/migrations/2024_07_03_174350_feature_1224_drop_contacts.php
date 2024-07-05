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
            $table->dropForeign('apartments_contact_id_foreign');
            $table->dropColumn('contact_id');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign('offers_contact_id_foreign');
            $table->dropColumn('contact_id');
        });
        Schema::dropIfExists('contacts');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->string('salutation', 10)->nullable();
            $table->json('email')->nullable();
            $table->json('phone')->nullable();
            $table->date('last_contact_date')->nullable();
            $table->time('last_contact_time')->nullable();
            $table->timestamps();
            $table->foreignId('address_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('apartments', function (Blueprint $table) {
            $table->foreignId('contact_id')
                  ->nullable()
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('contact_id')
                  ->nullable()
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }
};
