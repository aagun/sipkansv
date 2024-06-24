<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Kbli;
use App\Models\SubSector;

class KbliUpdateRequest extends BaseRequest
{
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
                Rule::unique(Kbli::class, 'code')
            ],
            'name' => [
                'sometimes',
                'required',
                'string',
                Rule::unique(Kbli::class, 'name')
            ],
            'sub_sector_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(SubSector::class, 'id')
            ],
        ];
    }
}
