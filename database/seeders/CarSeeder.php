<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\User;
use App\Car;

class CarSeeder extends Seeder
{
    public function run()
    {
        User::query()->each(
            fn (User $user) => Car::factory()
                ->for($user)
                ->count(5)
                ->create()
        );
    }
}
