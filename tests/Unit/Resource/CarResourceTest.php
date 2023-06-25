<?php

namespace Tests\Unit\Resource;

use App\Car;
use App\User;
use App\Http\Resources\CarResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CarResourceTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testCarResource()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);

        $carResource = (new CarResource($car))->resolve();

        $this->assertEquals($car->id, $carResource['id']);
        $this->assertEquals($car->make, $carResource['make']);
        $this->assertEquals($car->model, $carResource['model']);
        $this->assertEquals($car->year, $carResource['year']);
    }
}
