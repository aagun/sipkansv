<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\BusinessEntityType;

class BusinessEntityTypeCreateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => ucwords(trim($this->name))]);
        }

        if (isset($this->description)) {
            $this->merge(['description' => ucwords(trim($this->description))]);
        }
    }

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
