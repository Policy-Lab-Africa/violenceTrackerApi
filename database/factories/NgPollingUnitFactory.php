<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NgPollingUnit>
 */
class NgPollingUnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $pollingUnits = [
            0 => [
                "data_id" => 1,
                "name" => 'ABIA POLY - ABIA POLY I',
                "registration_area_id" => 1,
                "precise_location" => NULL,
                "abbreviation" => '005',
                "units" => '005',
                "delimitation" => '01/01/01/005',
                "remark" => 'EXISTING PU',
                "ward_id" => 1,
            ],
            0 => [
                "data_id" => 384240,
                "name" => 'MAITSABA / YAR YARA',
                "registration_area_id" => 19638,
                "precise_location" => NULL,
                "abbreviation" => '001',
                "units" => '001',
                "delimitation" => '36/14/02/001',
                "remark" => 'EXISTING PU',
                "ward_id" => 19638,
            ],
        ];

        $key = array_rand($pollingUnits);
        return [
            //
            'data_id' => $pollingUnits[$key]['data_id'],
            'name' => $pollingUnits[$key]['name'],
            'registration_area_id' => $pollingUnits[$key]['registration_area_id'],
            'precise_location' => $pollingUnits[$key]['precise_location'],
            'abbreviation' => $pollingUnits[$key]['abbreviation'],
            'units' => $pollingUnits[$key]['units'],
            'delimitation' => $pollingUnits[$key]['delimitation'],
            'remark' => $pollingUnits[$key]['remark'],
            'ward_id' => $pollingUnits[$key]['ward_id'],
        ];
    }
}
