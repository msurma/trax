<?php

namespace App\Policies;

use App\Trip;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;

    public function viewAny()
    {
        return true;
    }

    public function view(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id;
    }

    public function create()
    {
        return true;
    }

    public function delete(User $user, Trip $trip)
    {
        return $user->id === $trip->user_id;
    }
}
