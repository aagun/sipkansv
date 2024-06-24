<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Activity;

class ActivityUpdateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'numeric',
                Rule::exists(Activity::class, 'id')
            ],
            'name' => [
                'required',
                'string',
                Rule::unique(Activity::class, 'name')
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
        ];
    }
}
