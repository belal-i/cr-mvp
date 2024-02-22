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
        Schema::table('addresses', function(Blueprint $table) {
            $table->foreignId('house_id')->nullable();
        });
        Schema::table('houses', function(Blueprint $table) {
            $table->foreignId('address_id');
        });
        Schema::table('apartments', function(Blueprint $table) {
            $table->foreignId('house_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('addresses', function(Blueprint $table) {
            $table->dropColumn('house_id');
        });
        Schema::table('houses', function(Blueprint $table) {
            $table->dropColumn('address_id');
        });
        Schema::table('apartments', function(Blueprint $table) {
            $table->dropColumn('house_id');
        });
    }
};
