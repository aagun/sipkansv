<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Activity;

class ActivityReportExportRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            'start_inspection_date' => [
                'required',
                'date_format:Y-m-d',
                'before:end_inspection_date'
            ],
            'end_inspection_date' => [
                'required',
                'date_format:Y-m-d',
                'after_or_equal:start_inspection_date'
            ],
            'activity_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(Activity::class, 'id')
            ],
        ];
    }
}
