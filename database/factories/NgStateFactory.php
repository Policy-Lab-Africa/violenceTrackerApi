<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NgState>
 */
class NgStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $states = [
            0 => [
                'data_id' => 1,
                'name' => 'abia',
            ],
            1 => [
                'data_id' =>37,
                'name' =>'federal capital territory',
            ],
            2 => [
                'data_id' =>24,
                'name' =>'lagos',
            ],
            3 => [
                'data_id' =>2,
                'name' =>'adamawa',
            ]
        ];
        
        $key = array_rand($states);

        return [
            //
            'data_id' => $states[$key]['data_id'],
            'name' => $states[$key]['name'],
            'capital' => null,
            'latitude' => null,
            'longitude' => null,
        ];
    }
}
