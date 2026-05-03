<?php

namespace Tests\Feature;

use App\Models\NgLocalGovernment;
use App\Models\NgWard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class NgWardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fetches wards in local government areas successfully.
     *
     *
     * @return void
     */
    #[Test]
    public function get_wards()
    {
        $lga = NgLocalGovernment::factory()->has(NgWard::factory()->count(4), 'wards')->create();
        $response = $this->get('api/lgas/'.$lga->data_id.'/wards');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'wards' => [],
            ],
        ]);
    }
}
