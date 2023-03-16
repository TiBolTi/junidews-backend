<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AirportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sql = file_get_contents(database_path('seeders\seeds\airports.sql'));
        DB::unprepared($sql);
    }
}
