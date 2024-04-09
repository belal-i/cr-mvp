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
        /*
         * It's OK to do it this way, because we're still in alpha
         * phase, and regularly drop the database anyway. Once we reach
         * beta phase, we'll likely squash all the migrations to a single
         * schema, and then we can't be so carefree about dropping
         * columns anymore. 
            * */
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('smoking_ok');
        });
        Schema::table('apartments', function (Blueprint $table) {
            $table->boolean('smoking_ok')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn('smoking_ok');
        });
        Schema::table('offers', function (Blueprint $table) {
            $table->boolean('smoking_ok')->nullable();
        });
    }
};
