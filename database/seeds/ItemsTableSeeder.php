<?php

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use App\Models\Location;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'location_id' => Location::where('name', 'Frumbledingle Corp')->first()->id,
            'category_id' => Category::where('name', 'Widgets')->first()->id,
            'name' => 'Item A',
            'price' => 10
        ]);

        Item::create([
            'location_id' => Location::where('name', 'Frumbledingle Corp')->first()->id,
            'category_id' => Category::where('name', 'Chevrolet')->first()->id,
            'name' => 'Item B',
            'price' => 2000
        ]);

        Item::create([
            'location_id' => Location::where('name', 'Frumbledingle Corp')->first()->id,
            'category_id' => Category::where('name', 'Nissan')->first()->id,
            'name' => 'Item C',
            'price' => 3000
        ]);

        Item::create([
            'location_id' => Location::where('name', 'Plupbuckle, Inc.')->first()->id,
            'category_id' => Category::where('name', 'Widgets')->first()->id,
            'name' => 'Item D',
            'price' => 40
        ]);

        Item::create([
            'location_id' => Location::where('name', 'Plupbuckle, Inc.')->first()->id,
            'category_id' => Category::where('name', 'Chevrolet')->first()->id,
            'name' => 'Item E',
            'price' => 3600
        ]);

        Item::create([
            'location_id' => Location::where('name', 'Plupbuckle, Inc.')->first()->id,
            'category_id' => Category::where('name', 'Nissan')->first()->id,
            'name' => 'Item F',
            'price' => 3200
        ]);
        
        Item::create([
            'location_id' => Location::where('name', 'Plupbuckle, Inc.')->first()->id,
            'category_id' => Category::where('name', 'Louis Vuitton')->first()->id,
            'name' => 'Item G',
            'price' => 200
        ]);
    }
}
