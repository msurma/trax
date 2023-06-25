<?php

namespace Tests\Unit\Resource;

use App\Trip;
use App\User;
use App\Car;
use App\Http\Resources\TripResource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TripResourceTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    public function testTripResource()
    {
        $user = User::factory()->create();
        $car = Car::factory()->create(['user_id' => $user->id]);
        $trip = Trip::factory()->create(
            ['user_id' => $user, 'car_id' => $car->id]
        );

        $tripResource = (new TripResource($trip))->resolve();

        $this->assertEquals($trip->id, $tripResource['id']);
        $this->assertEquals($trip->date->toDateString(), $tripResource['date']);
        $this->assertEquals($trip->miles, $tripResource['miles']);
        $this->assertEquals($trip->total ?? 0, $tripResource['total']);
    }
}
