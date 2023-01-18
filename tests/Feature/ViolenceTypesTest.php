<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ViolenceTypesTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;
    /**
     * A HTTP test for successful response from the violence test endpoint.
     *
     * @return void
     */
    public function testGetViolenceTypesIsSuccessful()
    {
        $response = $this->get('api/violence-types');

        $response->assertStatus(200)
        ->assertJson([
            "status" => "success",
            "data" => []
        ]);
    }
}
