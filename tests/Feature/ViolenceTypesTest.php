<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class ViolenceTypesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A HTTP test for successful response from the violence test endpoint.
     *
     *
     * @return void
     */
    #[Test]
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
