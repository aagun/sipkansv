<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubDistrictResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->sub_district_id,
            'name' => $this->sub_district_name,
            'district_name' => $this->district_name,
        ];
    }
}
