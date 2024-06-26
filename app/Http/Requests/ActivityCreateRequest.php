<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Activity;

class ActivityCreateRequest extends BaseRequest
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
                Rule::unique(Activity::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
