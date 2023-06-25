<?php

namespace Database\Factories;

use App\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'make' => $this->faker->randomElement(['Ford', 'Toyota', 'BMW', 'Mercedes']),
            'model' => $this->faker->word(),
            'year' => $this->faker->numberBetween(2000, 2023),
        ];
    }
}
