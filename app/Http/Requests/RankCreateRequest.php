<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Rank;

class RankCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
