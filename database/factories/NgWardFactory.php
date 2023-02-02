<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NgWard>
 */
class NgWardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $wards = [
            0 => [
                "data_id" => 1,
                "name" => 'EZIAMA',
                "abbreviation" => '01',
                "local_government_id" => 1
            ],
            1 => [
                
                "data_id" => 16,
                "name" => 'NGWA',
                "abbreviation" => '04',
                "local_government_id" => 2
            ],
            2 => [
                
                "data_id" => 19702,
                "name" => 'GWARINPA',
                "abbreviation" => '05',
                "local_government_id" => 281
            ],
        ];

        $key = array_rand($wards);

        return [
            //
            'data_id' => $wards[$key]['data_id'],
            'name' => $wards[$key]['name'],
            'abbreviation' => $wards[$key]['abbreviation'],
            'local_government_id' => $wards[$key]['local_government_id'],
        ];
    }
}
