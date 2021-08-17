<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Category;

class CategoryTest extends TestCase
{
    /**
     * Test to create new parent Category
     */
    public function test_create_parent_category()
    {
        $response = $this->postJson('/api/categories', ['parent_id' => -1, 'name' => 'Category 1']);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * Test to create new Category
     */
    public function test_create_category()
    {
        $category = Category::where('name', 'Category 1')->latest()->first();
        $response = $this->postJson('/api/categories', ['parent_id' => $category->id, 'name' => 'Category 1.1']);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * Test to delete a Category
     */
    public function test_delete_category()
    {
        $category = Category::where('name', 'Category 1.1')->latest()->first();
        $response = $this->deleteJson('/api/categories/'.$category->id);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * Test to delete a parent Category
     */
    public function test_delete_parent_category()
    {
        $category = Category::where('name', 'Category 1')->latest()->first();
        $response = $this->deleteJson('/api/categories/'.$category->id);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }
}
