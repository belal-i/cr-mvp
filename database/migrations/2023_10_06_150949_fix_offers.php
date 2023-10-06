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
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('contact_id')->nullable()->change();
            $table->date('start_date')->nullable()->change();
            $table->date('end_date')->nullable()->change();
            $table->smallInteger('min_months')->nullable()->change();
            $table->smallInteger('max_months')->nullable()->change();
            $table->tinyInteger('number_of_persons')->nullable()->change();
            $table->boolean('smoking_ok')->nullable()->change();
            $table->integer('rent')->nullable()->change();
            $table->string('security_deposit_type', 20)->nullable()->change();
            // TODO: Our current normalized data requires this to be
            // a string, but it would be better as an integer.
            $table->string('security_deposit', 30)->nullable()->change();
            $table->string('reference')->nullable()->change();
            $table->json('notes')->nullable()->change();
            $table->date('date_created')->nullable()->change();
            $table->string('last_changed_by', 5)->nullable()->change();
            // TODO: Maybe use Laravel's timestamps for these.
            $table->date('date_last_changed')->nullable()->change();
            $table->time('time_last_changed')->nullable()->change();
            $table->string('status', 5)->nullable()->change();
            $table->boolean('publish_on_immoscout')->nullable()->change();
            $table->boolean('va_was_sent')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('contact_id')->nullable(false)->change();
            $table->date('start_date')->nullable(false)->change();
            $table->date('end_date')->nullable(false)->change();
            $table->tinyInteger('min_months')->nullable(false)->change();
            $table->tinyInteger('max_months')->nullable(false)->change();
            $table->tinyInteger('number_of_persons')->nullable(false)->change();
            $table->boolean('smoking_ok')->nullable(false)->change();
            $table->smallInteger('rent')->nullable(false)->change();
            $table->string('security_deposit_type', 20)->nullable(false)->change();
            // TODO: Our current normalized data requires this to be
            // a string, but it would be better as an integer.
            $table->string('security_deposit', 30)->nullable(false)->change();
            $table->string('reference')->nullable(false)->change();
            $table->json('notes')->nullable(false)->change();
            $table->date('date_created')->nullable(false)->change();
            $table->string('last_changed_by', 5)->nullable(false)->change();
            // TODO: Maybe use Laravel's timestamps for these.
            $table->date('date_last_changed')->nullable(false)->change();
            $table->time('time_last_changed')->nullable(false)->change();
            $table->string('status', 5)->nullable(false)->change();
            $table->boolean('publish_on_immoscout')->nullable(false)->change();
            $table->boolean('va_was_sent')->nullable(false)->change();
        });
    }
};
