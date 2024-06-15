<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Role;

class RoleUpdateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => strtoupper($this->name)]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string',
                'min:4',
                'max:50',
                'starts_with:RO_',
                Rule::unique(Role::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ]
        ];
    }
}
