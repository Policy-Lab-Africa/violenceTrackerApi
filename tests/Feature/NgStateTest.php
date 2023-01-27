<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgStateTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;


    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('migrate:fresh --seed --seeder=NgStateSeeder');
        // alternatively you can call
        // $this->seed();
    }

    /**
     * Test that /api/states returns 200.
     *
     * @return void
     */
    public function testGetNgStatesIsSuccessful()
    {
        $response = $this->get('api/states');

        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'data' => [],
        ]);
    }

    /**
     * Test that /api/states/{ngState} returns 200.
     *
     * @return void
     */
    public function testGetANigerianStateIsSuccessful()
    {
        $response = $this->get('api/states/1');

        $response->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'data' => [
                'state' => [
                    "id" => 1
                ]
            ],
        ]);
    }
}
