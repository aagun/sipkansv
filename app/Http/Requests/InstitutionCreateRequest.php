<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Institution;

class InstitutionCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
