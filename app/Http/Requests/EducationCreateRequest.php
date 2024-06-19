<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Education;

class EducationCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Education::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
