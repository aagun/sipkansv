<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Department;

class DepartmentUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Department::class, 'id')
            ],
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
