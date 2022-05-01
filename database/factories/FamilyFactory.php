<?php

namespace Database\Factories;

use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_name' => $this->faker->name(),
            'holdhouse_id' => $this->faker->numerify('####'),
            'person_qty' => $this->faker->randomDigitNotZero(),
            'address' => $this->faker->address(),
            'ward_id' => Ward::all()->random()->id
        ];
    }
}
