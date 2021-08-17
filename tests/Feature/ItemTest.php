<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Category;
use App\Models\Location;
use App\Models\Item;

class ItemTest extends TestCase
{
    /**
     * Test to create new Item
     */
    public function test_create_location()
    {
        $category = Category::first();
        $location = Location::first();

        $response = $this->postJson('/api/items', 
                                    [
                                        'category' => $category->id, 
                                        'location' => $location->id, 
                                        'name' => 'Item 1',
                                        'price' => 201.24
                                    ]);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * Test to delete an Item
     */
    public function test_delete_location()
    {
        $item = Item::where('name', 'Item 1')->latest()->first();
        $response = $this->deleteJson('/api/items/'.$item->id);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }
}
