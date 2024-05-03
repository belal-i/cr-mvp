<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\ApartmentSeeder;
use Database\Seeders\OfferSeeder;
use Database\Seeders\TextSeeder;
use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AddressSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(ApartmentSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(TextSeeder::class);
        $this->call(UserSeeder::class);
    }
}
