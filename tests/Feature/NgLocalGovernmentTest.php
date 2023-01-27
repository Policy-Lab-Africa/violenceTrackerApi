<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgLocalGovernmentTest extends TestCase
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
     * Fetches local government areas successfully.
     *
     * @test
     * @return void
     */
    public function getLocalGovernmentsForASpecifiedState()
    {
        $knownStateDataIds = [32, 24, 37];
        $response = $this->get('api/states/'.$knownStateDataIds[array_rand($knownStateDataIds)].'/lgas');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
        ]);
    }
}
