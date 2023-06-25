<?php

namespace App\Http\Controllers;

use App\Car;
use App\Http\Requests\StoreTripRequest;
use App\Http\Resources\TripResource;
use App\Repositories\TripRepository;
use App\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct(protected TripRepository $tripRepository)
    {
        $this->authorizeResource(Trip::class);
    }
    public function index(Request $request)
    {
        $trips = $this->tripRepository->getTripCollectionForUser($request->user()->id);

        return TripResource::collection($trips);
    }

    public function store(StoreTripRequest $storeTripRequest)
    {
        $tripData = array_merge([
            ...$storeTripRequest->validated(),
            'user_id' => $storeTripRequest->user()->id,
        ]);

        $car = Car::find($storeTripRequest->car_id);
        if ($car && $this->authorize('createTrip', $car)) {
            $trip = Trip::create($tripData);
        } else {
            return response(status: 403);
        }

        return new TripResource($trip);
    }

    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();

        return response()->json();
    }
}
