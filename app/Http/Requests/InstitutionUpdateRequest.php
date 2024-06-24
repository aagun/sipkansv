<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Institution;

class InstitutionUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Institution::class, 'id')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(Institution::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
