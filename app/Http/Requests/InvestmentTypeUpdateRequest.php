<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\InvestmentType;

class InvestmentTypeUpdateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => strtoupper(trim($this->name))]);
        }

        if (isset($this->description)) {
            $this->merge(['description' => ucwords(trim($this->description))]);
        }
    }

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(InvestmentType::class, 'id')
            ],
            'name' => [
                'sometimes',
                'required',
                'string',
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
