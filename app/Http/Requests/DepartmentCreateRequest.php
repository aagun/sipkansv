<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Department;

class DepartmentCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Department::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
