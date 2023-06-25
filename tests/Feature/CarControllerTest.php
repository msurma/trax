<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;
use App\Car;

class CarControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testUserCanCreateCar()
    {
        $user = User::factory()->create();
        $this->be($user);
        $carData = ['make' => 'Toyota', 'model' => 'Corolla', 'year' => '2000'];

        $response = $this->postJson(route('cars.store'), $carData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('cars', $carData);
    }

    public function testUserCanReadCreatedCar()
    {
        $user = User::factory()->create();
        $this->be($user);
        $car = Car::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson(route('cars.index'));

        $response->assertStatus(200);
        $response->assertJsonFragment(['make' => $car->make, 'model' => $car->model, 'year' => $car->year]);
    }
}
