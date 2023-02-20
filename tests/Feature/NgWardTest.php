<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\NgWard;
use App\Models\NgLocalGovernment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class NgWardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fetches wards in local government areas successfully.
     *
     * @test
     * @return void
     */
    public function getWards()
    {
        $lga = NgLocalGovernment::factory()->has(NgWard::factory()->count(4), 'wards')->create();
        $response = $this->get('api/lgas/'.$lga->data_id.'/wards');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'wards' => []
            ],
        ]);
    }
}
