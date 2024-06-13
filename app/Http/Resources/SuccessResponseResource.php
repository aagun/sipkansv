<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\HttpResponseStatus;

class SuccessResponseResource extends BaseResponseResource
{
    public function __construct($resource, $resourceClass = null, string $message = null)
    {
        $resource = $resourceClass ? $resourceClass::collection($resource) : $resource;

        parent::__construct(
            HttpResponseStatus::SUCCESS,
            $message,
            null,
            $resource
        );
    }

}
