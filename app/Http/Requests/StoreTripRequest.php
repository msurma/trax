<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
    public function rules()
    {
        return [
            'date' => ['required', 'date', 'before_or_equal:today'],
            'car_id' => ['required', 'exists:App\Car,id'],
            'miles' => ['required', 'numeric', 'min:0'],
        ];
    }
}
