<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\SubSector;

class SubSectorUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(SubSector::class, 'id')
            ],
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
