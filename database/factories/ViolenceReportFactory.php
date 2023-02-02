<?php

namespace Database\Factories;

use App\Models\NgState;
use App\Models\ViolenceType;
use App\Models\NgPollingUnit;
use App\Models\NgLocalGovernment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ViolenceReport>
 */
class ViolenceReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $state = NgState::factory()->create();
        $lga = NgLocalGovernment::factory()->create();
        $pollingUnit = NgPollingUnit::factory()->create();
        $type = ViolenceType::factory()->create();
        
        return [
            //
            'ng_state_id' => $state->id,
            'ng_local_government_id' => $lga->id,
            'ng_polling_unit_id' => $pollingUnit->id,
            'type_id' => $type->id,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'file' => '/files/qwerfsdkjlkjb.png',
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'longitude' => $this->faker->longitude(),
            'latitude' => $this->faker->latitude(),
        ];
    }
}
