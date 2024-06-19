<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\InvestmentType;

class InvestmentTypeCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
