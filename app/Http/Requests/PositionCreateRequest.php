<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Position;

class PositionCreateRequest extends BaseRequest
{
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
