<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AddressSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(ApartmentSeeder::class);
        $this->call(OfferSeeder::class);
        $this->call(RenterSeeder::class);
        $this->call(TextSeeder::class);
        $this->call(ImageSeeder::class);

        // TODO: Improve/remove this.
        // // TODO: We may want to store the images in another path.
        // if (env('APP_ENV') === 'local') {
        //     try {
        //         $phar = new \PharData(database_path() . '/images.tar.gz');
        //         $phar->extractTo(storage_path() . '/app/public/');
        //     } catch (\PharException) {
        //         // Files already exist.
        //     }
        // }
    }
}
