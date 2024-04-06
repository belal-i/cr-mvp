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
            // TODO: See Feature #986. Many of these fields should be
            // enums
            $table->string('bathroom_description', 40)->nullable();
            $table->string('bathroom_equipment', 40)->nullable();
            $table->json(  'bathroom_furniture')->nullable();
            $table->string('bathroom_type', 60)->nullable();

            $table->boolean('has_television')->nullable();

            $table->string('kitchen_description', 40)->nullable();
            $table->string('kitchen_equipment', 40)->nullable();
            $table->json(  'kitchen_furniture')->nullable();
            $table->string('kitchen_situation', 80)->nullable();
            $table->string('kitchen_type', 60)->nullable();

            $table->json('luxury_items')->nullable();
            $table->tinyInteger('television_size_inches')->nullable();
            $table->json('windows')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropColumn([
                'bathroom_description',
                'bathroom_equipment',
                'bathroom_furniture',
                'bathroom_type',
                'has_television',
                'kitchen_description',
                'kitchen_equipment',
                'kitchen_furniture',
                'kitchen_situation',
                'kitchen_type',
                'luxury_items',
                'television_size_inches',
                'windows',
            ]);
        });
    }
};
