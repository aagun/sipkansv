<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Recommendation;

class RecommendationCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                Rule::unique(Recommendation::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
