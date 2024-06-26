<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Education;

class EducationUpdateRequest extends BaseRequest
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
            'name' => trim(strtoupper($this->name)),
        ]);
    }


    public function rules(): array
    {
        return [

            'id' => [
                'required',
                'numeric',
                Rule::exists(Education::class, 'id')
            ],
            'name' => [
                'sometimes',
                'required',
                'string'
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
