<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Observation;

class ObservationUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Observation::class, 'id')
            ],
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
