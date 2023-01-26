<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgWardTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->artisan('migrate:fresh --seed');
        // alternatively you can call
        // $this->seed();
    }

    /**
     * Fetches wards in local government areas successfully.
     *
     * @test
     * @return void
     */
    public function getWards()
    {
        $knownLgaDataIds = [507, 676, 277];
        $response = $this->get('api/lgas/'.$knownLgaDataIds[array_rand($knownLgaDataIds)].'/wards');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
        ]);
    }
}
