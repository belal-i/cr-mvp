<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'it@city-residence.de',
            'password' => Hash::make(
                env(
                    'BACKPACK_DEFAULT_ADMIN_PASSWORD',
                    'insecure-please-change-me'
                )
            ),
        ]);
    }
}
