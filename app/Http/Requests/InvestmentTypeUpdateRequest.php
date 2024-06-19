<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\InvestmentType;

class InvestmentTypeUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(InvestmentType::class, 'id')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(InvestmentType::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
