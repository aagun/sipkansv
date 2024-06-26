<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Position;

class PositionCreateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->name)) {
            $this->merge(['name' => ucwords(trim($this->name))]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Position::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
