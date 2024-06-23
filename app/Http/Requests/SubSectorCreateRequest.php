<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\SubSector;

class SubSectorCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(SubSector::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
