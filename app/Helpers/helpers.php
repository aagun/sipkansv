<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Http\Resources\ErrorResponseResource;

if (!function_exists('validateExistenceDataById')) {
    function validateExistenceDataById(mixed $id, $serviceClass): void
    {
        if (!$serviceClass->exists($id)) {
            $errors = ['id' => ["The selected $id is invalid."]];
            throw new HttpResponseException(response(
                new ErrorResponseResource($errors),
                Response::HTTP_NOT_FOUND
            ));
        }
    }
}
