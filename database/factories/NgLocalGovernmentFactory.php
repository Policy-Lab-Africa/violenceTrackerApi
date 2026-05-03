<?php

namespace Database\Factories;

use App\Models\NgLocalGovernment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NgLocalGovernment>
 */
class NgLocalGovernmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $localGovernments = [
            0 => [
                'data_id' => 1,
                'name' => 'ABA NORTH',
                'abbreviation' => '01',
                'state_id' => 1,
            ],
            1 => [
                'data_id' => 281,
                'name' => 'MUNICIPAL',
                'abbreviation' => '06',
                'state_id' => 37,
            ],
        ];

        $key = array_rand($localGovernments);

        return [
            //
            'data_id' => $localGovernments[$key]['data_id'],
            'name' => $localGovernments[$key]['name'],
            'abbreviation' => $localGovernments[$key]['abbreviation'],
            'state_id' => $localGovernments[$key]['state_id'],
        ];
    }
}
