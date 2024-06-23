<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\SubSector;
use App\Models\Kbli;

class KbliCreateRequest extends BaseRequest
{
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
