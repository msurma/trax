<?php

namespace App\Policies;

use App\Car;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Car $car)
    {
        return $user->id === $car->user_id;
    }

    public function delete(User $user, Car $car)
    {
        return $user->id === $car->user_id;
    }

    public function viewAny()
    {
        return true;
    }

    public function create()
    {
        return true;
    }

    public function createTrip(User $user, Car $car)
    {
        return $user->id === $car->user_id;
    }
}
