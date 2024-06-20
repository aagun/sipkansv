<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Observation;

class ObservationCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Observation::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
