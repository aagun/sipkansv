<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Kbli;

class KbliUpdateRequest extends BaseRequest
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
                Rule::exists(Kbli::class, 'id')
            ],
            'code' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'name' => [
                'sometimes',
                'required',
                'string',
            ],
            'sub_sector_id' => [
                'sometimes',
                'required',
                'numeric',
            ],
        ];
    }
}
