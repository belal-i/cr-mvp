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
            $table->string('company', 80)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('has_identification')->default(false);
            $table->string('employer', 80)->nullable();
            $table->string('job_type', 50)->nullable();
            $table->enum('gender', [
                'MALE',
                'FEMALE',
                'COUPLE',
                'UNKNOWN',
            ])->default('UNKNOWN');
            $table->enum('role', [
                'LANDLORD',
                'RENTER',
                'UNKNOWN',
            ])->default('UNKNOWN');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'company',
                'date_of_birth',
                'has_identification',
                'employer',
                'job_type',
                'gender',
                'role',
            ]);
        });
    }
};
