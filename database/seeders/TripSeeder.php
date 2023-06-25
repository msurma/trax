<?php

namespace Database\Seeders;

use App\Trip;
use App\Car;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    public function run()
    {
        Car::query()->each(
            fn (Car $car) => Trip::factory()
                ->for($car)
                ->for($car->user)
                ->count(10)
                ->create()
        );
    }
}
