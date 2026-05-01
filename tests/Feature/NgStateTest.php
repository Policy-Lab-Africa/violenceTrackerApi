<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\NgState;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgStateTest extends TestCase
{
    use RefreshDatabase;

    public $states;

    public function setUp(): void
    {
        parent::setUp();
        $this->states = NgState::factory()->count(3)->create();
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
            'data' => [
                'states' => []
            ],
        ]);
    }

    /**
     * Test that /api/states/{ngState} returns 200.
     *
     * @return void
     */
    public function testGetANigerianStateIsSuccessful()
    {
        $responseName = $this->get('api/states/'.$this->states->first()->name);
        $responseId = $this->get('api/states/'.$this->states->first()->data_id);

        $responseName->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'data' => [
                'state' => [
                    "name" => $this->states->first()->name
                ]
            ],
        ]);

        $responseId->assertStatus(200)
        ->assertJson([
            'status' => 'success',
            'data' => [
                'state' => [
                    "name" => $this->states->first()->name
                ]
            ],
        ]);
    }
}
