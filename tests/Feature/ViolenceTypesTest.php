<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViolenceTypesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A HTTP test for successful response from the violence test endpoint.
     *
     * @test
     *
     * @return void
     */
    public function get_violence_types_is_successful()
    {
        $response = $this->get('api/violence-types');

        $response->assertStatus(200)
            ->assertJson([
                'status' => 'success',
                'data' => [
                    'types' => [],
                ],
            ]);
    }
}
