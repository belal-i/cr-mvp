<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends CrNormalizedSeeder
{
    protected $table = 'users';

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        parent::run();
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'me@me.me',
            'email_verified_at' => date('Y-m-d'),
            'password' => Hash::make(
                env(
                    'BACKPACK_DEFAULT_ADMIN_PASSWORD',
                    'insecure-please-change-me'
                )
            ),
            'role' => 'ADMIN',
        ]);
    }
}
