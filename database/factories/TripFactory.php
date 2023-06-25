<?php

namespace Database\Factories;

use App\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'miles' => $this->faker->randomFloat(1, 10, 500),
        ];
    }
}
