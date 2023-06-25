<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCarRequest;
use App\Http\Resources\CarResource;

class CarController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Car::class);
    }

    public function index(Request $request)
    {
        return CarResource::collection(
            $request->user()->cars()->get()
        );
    }

    public function store(StoreCarRequest $storeCarRequest)
    {
        $carData = array_merge([
                ...$storeCarRequest->validated(),
                'user_id' => $storeCarRequest->user()->id
        ]);

        $car = Car::create($carData);

        return new CarResource($car);
    }

    public function show(Car $car)
    {
        $car = $car->loadCount('trips')
            ->loadSum('trips', 'miles');

        return new CarResource($car);
    }

    public function destroy(Car $car)
    {
        $status = $car->delete();

        return $status ? response()->json() : response(status: 500);
    }
}
