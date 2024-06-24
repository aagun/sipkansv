<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Activity;

class ActivityCreateRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
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
