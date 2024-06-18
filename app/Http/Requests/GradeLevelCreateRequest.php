<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\GradeLevel;

class GradeLevelCreateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => strtoupper($this->name)]);
        }

        if (isset($this->description)) {
            $this->merge(['description' => strtoupper($this->description)]);
        }
    }

    protected function passedValidation(): void
    {
        $this->merge([
            'name' => strtoupper($this->name),
            'description' => strtoupper($this->description)
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(GradeLevel::class, 'name')
            ],
            'description' => [
                'required',
                'string',
                Rule::unique(GradeLevel::class, 'description')
            ],
        ];
    }
}
