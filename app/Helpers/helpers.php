<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\Pagination\SuccessPageableResponseCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

if (!function_exists('validateExistenceDataById')) {
    function validateExistenceDataById(mixed $id, $serviceClass): void
    {
        if (!$serviceClass->exists($id)) {
            exceptionIdNotFound();
        }
    }

    function validateId($id): void
    {
        if (!isset($id)) exceptionIdNotFound();
    }

    function exceptionIdNotFound()
    {
        $errors = ['id' => ["The selected id is invalid."]];
        throw new HttpResponseException(response(
            new ErrorResponseResource($errors),
            Response::HTTP_NOT_FOUND
        ));
    }

    function validateSort($filter, $permissibleSort, $defaultSort): bool
    {
        return isset($filter['sort']) && in_array($filter['sort'], array_keys($permissibleSort)) ? : $defaultSort;
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

    function ok(?string $message = null, $resource = null, $resourceClass = null, bool $paginate = false): Response | ResourceCollection

    {
        if ($paginate) {
            return new SuccessPageableResponseCollection(
                $resource,
                $message,
                $resourceClass
            );
        }

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


    function p_info($data): void
    {
        Log::info($data);
    }

    function print_json(mixed $data): void
    {
        $json = json_decode($data);
        $json = $json == null ? $data : $json;
        Log::info(json_encode($json, JSON_PRETTY_PRINT));
    }
}
