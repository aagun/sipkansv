<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\SuccessResponseResource;

if (!function_exists('validateExistenceDataById')) {
    function validateExistenceDataById(mixed $id, $serviceClass): void
    {
        if (!$serviceClass->exists($id)) {
            exceptionIdNotFound();
        }
    }

    function exceptionIdNotFound()
    {
        $errors = ['id' => ["The selected id is invalid."]];
        throw new HttpResponseException(response(
            new ErrorResponseResource($errors),
            Response::HTTP_NOT_FOUND
        ));
    }

    function error($status = null, ?string $message = null, $errors = null): Response
    {
        return response(
            new ErrorResponseResource(
                $errors,
                $message
            ),
            isset($status) ? $status : Response::HTTP_BAD_REQUEST
        );
    }

    function success($status = null, ?string $message = null, $resource = null, $resourceClass = null): Response
    {
        return response(
            new SuccessResponseResource(
                $resource,
                $resourceClass,
                $message
            ),
            isset($status) ? $status : Response::HTTP_OK
        );
    }

    function ok(?string $message = null, $resource = null, $resourceClass = null): Response
    {
        return response(
            new SuccessResponseResource(
                $resource,
                $resourceClass,
                $message
            )
        );
    }

    function created(?string $message = null, $resource = null, $resourceClass = null): Response
    {
        return response(
            new SuccessResponseResource(
                $resource,
                $resourceClass,
                $message
            ),
            Response::HTTP_CREATED
        );
    }


}
