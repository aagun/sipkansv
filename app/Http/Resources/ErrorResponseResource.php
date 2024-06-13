<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\HttpResponseStatus;

class ErrorResponseResource extends BaseResponseResource
{
    public function __construct($errors, string $message = 'error')
    {
        parent::__construct(
            HttpResponseStatus::ERROR,
            $message,
            $errors,
            null
        );
    }
}
