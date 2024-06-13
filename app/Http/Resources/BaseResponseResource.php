<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enums\HttpResponseStatus;

class BaseResponseResource extends JsonResource
{
    public HttpResponseStatus $status;
    public string $message;
    public mixed $errors;

    public function __construct(HttpResponseStatus $status, string $message, mixed $errors = null, $resource = null)
    {
        parent::__construct($resource);

        $this->status = $status;
        $this->message = $message;
        $this->errors = $errors;
    }

    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status->value,
            'message' => $this->message,
            'data' => $this->resource,
            'errors' => $this->errors
        ];
    }
}
