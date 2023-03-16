<?php

namespace Database\Seeders;

use App\Models\ServiceCodes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           AirportsTableSeeder::class,
           AirlinesTableSeeder::class,
           ServiceCodesTableSeeder::class,
           CountriesTableSeeder::class,
           PlanesTableSeeder::class,
           StatesTableSeeder::class
        ]);
    }
}
