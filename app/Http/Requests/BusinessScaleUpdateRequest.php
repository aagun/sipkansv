<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\BusinessScale;

class BusinessScaleUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(BusinessScale::class, 'id')
            ],
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
