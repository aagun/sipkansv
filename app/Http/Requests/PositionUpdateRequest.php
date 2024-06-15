<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Position;

class PositionUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Position::class, 'id')
            ],
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
