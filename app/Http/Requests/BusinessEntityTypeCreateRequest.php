<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\BusinessEntityType;

class BusinessEntityTypeCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
