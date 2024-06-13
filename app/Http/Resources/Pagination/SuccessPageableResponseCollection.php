<?php

namespace App\Http\Resources\Pagination;

use App\Enums\HttpResponseStatus;

class SuccessPageableResponseCollection extends BasePageableResponseCollection

{
    public function __construct($resource, $message = null, $resourceClass = null)
    {
        $data = $resourceClass ? $resourceClass::collection($resource) : $resource;

        parent::__construct(
            HttpResponseStatus::SUCCESS,
            $message,
            $data,
            $resource,
            null
        );
    }
}
