<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Education;

class EducationCreateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => strtoupper($this->name)]);
        }
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'name' => strtoupper($this->name),
        ]);
    }

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
