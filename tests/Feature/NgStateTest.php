<?php

namespace Tests\Feature;

use App\Models\NgState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NgStateTest extends TestCase
{
    use RefreshDatabase;

    public $states;

    protected function setUp(): void
    {
        parent::setUp();
        $this->states = NgState::factory()->count(3)->create();
    }

    /**
     * Test that /api/states returns 200.
     *
     * @return void
     */
    public function test_get_ng_states_is_successful()
    {

        $response = $this->get('api/states');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'states' => [],
                ],
            ]);
    }

    /**
     * Test that /api/states/{ngState} returns 200.
     *
     * @return void
     */
    public function test_get_a_nigerian_state_is_successful()
    {
        $responseName = $this->get('api/states/'.$this->states->first()->name);
        $responseId = $this->get('api/states/'.$this->states->first()->data_id);

        $responseName->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'state' => [
                        'name' => $this->states->first()->name,
                    ],
                ],
            ]);

        $responseId->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'state' => [
                        'name' => $this->states->first()->name,
                    ],
                ],
            ]);
    }
}
