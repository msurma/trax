<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Car */
class CarResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            'trip_count' => $this->resource->trips_count ?? 0,
            'trip_miles' => $this->resource->trips_sum_miles ?? 0,
        ];
    }
}
