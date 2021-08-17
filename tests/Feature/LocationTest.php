<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Location;

class LocationTest extends TestCase
{
    /**
     * Test to create new Location
     */
    public function test_create_location()
    {
        $response = $this->postJson('/api/locations', ['name' => 'Location B']);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }

    /**
     * Test to delete a Location
     */
    public function test_delete_location()
    {
        $location = Location::where('name', 'Location B')->latest()->first();
        $response = $this->deleteJson('/api/locations/'.$location->id);

        $response
            ->assertStatus(200)
            ->assertJson(['status' => 'success']);
    }
}
