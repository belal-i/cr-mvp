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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contact_id');
            $table->foreignId('apartment_id');
            $table->string('source_id', 10);
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('min_months');
            $table->tinyInteger('max_months');
            $table->tinyInteger('number_of_persons');
            $table->boolean('smoking_ok');
            $table->smallInteger('rent');
            $table->string('security_deposit_type', 20);
            // TODO: Our current normalized data requires this to be
            // a string, but it would be better as an integer.
            $table->string('security_deposit', 30);
            $table->string('reference');
            $table->json('notes');
            $table->date('date_created');
            $table->string('last_changed_by', 5);
            // TODO: Maybe use Laravel's timestamps for these.
            $table->date('date_last_changed');
            $table->time('time_last_changed');
            $table->string('status', 5);
            $table->boolean('publish_on_immoscout');
            $table->boolean('va_was_sent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
