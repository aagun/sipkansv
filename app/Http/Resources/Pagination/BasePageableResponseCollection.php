<?php

namespace App\Http\Resources\Pagination;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Enums\HttpResponseStatus;

class BasePageableResponseCollection extends ResourceCollection
{
    private HttpResponseStatus $status;
    private string $message;
    private mixed $errors;
    private mixed $data;

    public function __construct(HttpResponseStatus $status, string $message, $data, $resource, $errors)
    {
        parent::__construct($resource);

        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;
    }

    public function paginationInformation($request, $paginated, $default)
    {
        $default['total'] = $default['meta']['total'];

        unset($default['links']);
        unset($default['meta']);
    }

    public function toArray(Request $request): array
    {
        return [
          "status" => $this->status->value,
          "message" => $this->message,
          "data" => $this->data,
          "errors" => $this->errors
        ];
    }
}
