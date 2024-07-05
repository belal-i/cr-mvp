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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('address_id')
                  ->nullable()
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('first_name', 20)->nullable();
            $table->string('last_name', 30)->nullable();
            // TODO: Make this an enum?
            $table->string('salutation', 10)->nullable();
            $table->json('phone')->nullable();
            // TODO: Consider the security implications of this.
            $table->string('password')->nullable()->change();
            $table->date('last_contact_date')->nullable();
            $table->time('last_contact_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_address_id_foreign');
            $table->dropColumn('address_id');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('salutation');
            $table->dropColumn('phone');
            $table->string('password')->nullable(false)->change();
            $table->dropColumn('last_contact_date');
            $table->dropColumn('last_contact_time');
        });
    }
};
