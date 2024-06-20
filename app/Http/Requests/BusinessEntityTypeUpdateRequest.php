<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\BusinessEntityType;

class BusinessEntityTypeUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(BusinessEntityType::class, 'id')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(BusinessEntityType::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
