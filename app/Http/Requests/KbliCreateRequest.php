<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\SubSector;
use App\Models\Kbli;

class KbliCreateRequest extends BaseRequest
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
            'code' => [
                'required',
                'numeric',
                Rule::unique(Kbli::class, 'code')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(Kbli::class, 'name')
            ],
            'sub_sector_id' => [
                'required',
                'numeric',
                Rule::exists(SubSector::class, 'id')
            ],
        ];
    }
}
