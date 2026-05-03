<?php

namespace Tests\Feature;

use App\Models\NgLocalGovernment;
use App\Models\NgState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class NgLocalGovernmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fetches local government areas successfully.
     *
     *
     * @return void
     */
    #[Test]
    public function get_local_governments_for_a_specified_state()
    {
        $state = NgState::factory()->has(NgLocalGovernment::factory()->count(3), 'lgas')->create();

        $response = $this->get('api/states/'.$state->data_id.'/lgas');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'local_government_areas' => [],
            ],
        ]);
    }
}
