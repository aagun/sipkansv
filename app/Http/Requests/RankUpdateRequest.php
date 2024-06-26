<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Rank;

class RankUpdateRequest extends BaseRequest
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
            'id' => [
                'required',
                'numeric',
                Rule::exists(Rank::class, 'id')
            ],
            'name' => [
                'sometimes',
                'required',
                'string',
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
