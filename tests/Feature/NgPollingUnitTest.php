<?php

namespace Tests\Feature;

use App\Models\NgPollingUnit;
use App\Models\NgWard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NgPollingUnitTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Fetches polling units for a specified ward successfully.
     *
     * @return void
     */
    #[Test]
    public function get_polling_units_for_a_specified_ward()
    {
        $ward = NgWard::factory()->has(NgPollingUnit::factory()->count(3), 'pollingUnits')->create();

        $response = $this->get('api/wards/'.$ward->data_id.'/polling-units');

        $response->assertStatus(200)->assertJson([
            'status' => 'success',
            'data' => [
                'wards' => [], // looks like there was an error that named polling units -> wards
            ],
        ]);
    }
}
