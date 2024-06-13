<?php

namespace App\Http\Resources\Pagination;

use App\Enums\HttpResponseStatus;

class ErrorPageableResponseCollection extends BasePageableResponseCollection
{
    public function __construct($errors, string $message = 'error')
    {
        parent::__construct(
            HttpResponseStatus::ERROR,
            $message,
            null,
            null,
            $errors
        );
    }

}
