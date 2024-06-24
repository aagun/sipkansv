<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Rank;

class RankUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Rank::class, 'id')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(Rank::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
