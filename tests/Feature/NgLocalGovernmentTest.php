<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\NgState;
use App\Models\NgLocalGovernment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgLocalGovernmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fetches local government areas successfully.
     *
     * @test
     * @return void
     */
    public function getLocalGovernmentsForASpecifiedState()
    {
        $state = NgState::factory()->has(NgLocalGovernment::factory()->count(3), 'lgas')->create();

        $response = $this->get('api/states/'.$state->data_id.'/lgas');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'local_government_areas' => []
            ],
        ]);
    }
}
