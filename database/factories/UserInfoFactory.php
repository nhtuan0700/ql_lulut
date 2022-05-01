<?php

namespace Database\Factories;

use App\Models\Ward;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone_number' => $this->faker->numerify('0#########'),
            'card_id' => $this->faker->numerify('############'),
            'ward_id' => Ward::all()->random()->id,
            'dob' => Carbon::parse($this->faker->date())->format('d/m/Y'),
            'gender' => $this->faker->randomElement([0,1]),
        ];
    }
}
