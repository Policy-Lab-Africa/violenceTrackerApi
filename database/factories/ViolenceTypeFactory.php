<?php

namespace Database\Factories;

use App\Models\ViolenceType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ViolenceType>
 */
class ViolenceTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->word(),
            'note' => $this->faker->sentence(),
        ];
    }
}
