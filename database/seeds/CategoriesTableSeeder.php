<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Widgets']);
        Category::create(['name' => 'Cars']);
        Category::create(['name' => 'Purses']);
        Category::create([
            'parent_id' => Category::where('name', 'Cars')->first()->id,
            'name' => 'Chevrolet'
        ]);
        Category::create([
            'parent_id' => Category::where('name', 'Cars')->first()->id,
            'name' => 'Nissan'
        ]);
        Category::create([
            'parent_id' => Category::where('name', 'Purses')->first()->id,
            'name' => 'Louis Vuitton'
        ]);
    }
}
