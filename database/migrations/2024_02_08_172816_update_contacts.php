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
            $table->foreignId('address_id')
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->dropColumn('street');
            $table->dropColumn('house_number');
            $table->dropColumn('zip_code');
            $table->dropColumn('city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('address_id');
            $table->string('street', 50)->nullable();
            $table->string('house_number', 40)->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('city', 30)->nullable();
        });
    }
};
