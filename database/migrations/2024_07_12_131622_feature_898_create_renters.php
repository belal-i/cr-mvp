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
        Schema::create('renters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->string('source_id', 10);
            $table->enum('status', [
                'FREE',
                'NOT_FREE',
                'RESERVED',
            ])->default('RESERVED');
            $table->tinyInteger('number_of_persons')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->smallInteger('min_months')->nullable();
            $table->smallInteger('max_rent')->nullable();
            $table->float('min_number_of_rooms', 5, 2)->nullable();
            $table->boolean('must_be_furnished')->default(false);
            $table->smallInteger('min_size_sq_m')->nullable();
            $table->json('notes')->nullable();
            $table->boolean('is_smoker')->default(false);
            $table->string('reference')->nullable();
            $table->string('last_changed_by', 5)->nullable();
            $table->string('account_manager', 5)->nullable();
            // TODO: See Feature #973. It would be better to let
            // Laravel's timestamps handle this information.
            $table->date('date_created')->nullable();
            $table->date('date_last_changed')->nullable();
            $table->time('time_last_changed')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renters');
    }
};
