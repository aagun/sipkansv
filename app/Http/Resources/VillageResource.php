<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VillageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->village_id,
            'name' => $this->village_name,
            'district_name' => $this->sub_district_name,
        ];
    }
}
