<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NgPuLocation>
 */
class NgPuLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pollingUnitLocations = [
            0 => [
                'ng_polling_unit_id' => '1',
                'latitude' => '5.1354436',
                'longitude' => '7.3536032',
                'viewport' => null,
                'formatted_address' => '119 Aba-Owerri Rd, Abayi 450102, Aba, Nigeria',
                'google_map_url' => 'https://maps.google.com?q=5.135443599999999,7.353603199999998',
                'google_place_id' => 'ChIJwZcb7HyZQhARxg1UT0ijeag',
            ],
            1 => [
                'ng_polling_unit_id' => '365465',
                'latitude' => null,
                'longitude' => null,
                'viewport' => null,
                'formatted_address' => null,
                'google_map_url' => null,
                'google_place_id' => null,
            ],
        ];

        $key = array_rand($pollingUnitLocations);

        return [
            //
            'ng_polling_unit_id' => $pollingUnitLocations[$key]['ng_polling_unit_id'],
            'latitude' => $pollingUnitLocations[$key]['latitude'],
            'longitude' => $pollingUnitLocations[$key]['longitude'],
            'viewport' => $pollingUnitLocations[$key]['viewport'],
            'formatted_address' => $pollingUnitLocations[$key]['formatted_address'],
            'google_map_url' => $pollingUnitLocations[$key]['google_map_url'],
            'google_place_id' => $pollingUnitLocations[$key]['google_place_id'],
        ];
    }
}
