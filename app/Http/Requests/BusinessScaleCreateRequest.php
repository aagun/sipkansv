<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\BusinessScale;

class BusinessScaleCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(BusinessScale::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
