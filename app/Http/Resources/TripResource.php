<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Trip */
class TripResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date?->toDateString(),
            'miles' => $this->miles,
            'total' => $this->total ?? 0,
            'car' => new CarResource($this->car),
        ];
    }
}
