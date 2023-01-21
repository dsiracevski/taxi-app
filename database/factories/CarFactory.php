<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CarFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'registration_number' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'is_active' => $this->faker->randomNumber(),
            'gas_type' => $this->faker->word(),
        ];
    }
}
