<?php

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create(['name' => 'Frumbledingle Corp']);
        Location::create(['name' => 'Plupbuckle, Inc.']);
    }
}
