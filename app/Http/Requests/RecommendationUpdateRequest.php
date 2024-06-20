<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Recommendation;

class RecommendationUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Recommendation::class, 'id')
            ],
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
