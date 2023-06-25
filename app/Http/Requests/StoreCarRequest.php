<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    public function rules()
    {
        return [
            'year' => ['required', 'date_format:Y', 'before_or_equal:today'],
            'make' => ['required', 'string'],
            'model' => ['required', 'string'],
        ];
    }
}
