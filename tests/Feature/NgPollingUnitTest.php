<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgPollingUnitTest extends TestCase
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
     * Fetches polling units for a specified ward successfully.
     *
     * @test
     * @return void
     */
    public function getPollingUnitsForASpecifiedWard()
    {
        $knownWardDataIds = [18814, 19648, 5860];
        $response = $this->get('api/wards/'.$knownWardDataIds[array_rand($knownWardDataIds)].'/polling-units');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [],
        ]);
    }
}
