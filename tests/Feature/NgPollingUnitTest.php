<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\NgWard;
use App\Models\NgPollingUnit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgPollingUnitTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * Fetches polling units for a specified ward successfully.
     *
     * @test
     * @return void
     */
    public function getPollingUnitsForASpecifiedWard()
    {
        $ward = NgWard::factory()->has(NgPollingUnit::factory()->count(3), 'pollingUnits')->create();

        $response = $this->get('api/wards/'.$ward->data_id.'/polling-units');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'wards' => [] // looks like there was an error that named polling units -> wards
            ],
        ]);
    }
}
