<?php

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\Pagination\SuccessPageableResponseCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Log;

if (!function_exists('validateExistenceDataById')) {

    define('PAGEABLE_PROPS', ['limit', 'offset', 'search', 'sort', 'order']);
    function validateExistenceDataById(mixed $id, $serviceClass): void
    {
        if (!$serviceClass->exists($id)) {
            exceptionNotFound('id');
        }
    }

    function validateUniqueDataByName(array $payload, $serviceClass): void
    {
        $model = $serviceClass->findOne($payload['id']);
        if (isset($payload['name']) && strtolower($model->name) !== strtolower($payload['name'])) {
            if ($serviceClass->existsByName($payload['name'])) {
                exceptionUnique('name');
            }
        }
    }

    function validateSoftDeleteDataById(mixed $id, $serviceClass, string $status): void
    {
        if (!$serviceClass->existsByStatus($id, $status)) {
            exceptionNotFound('id');
        }
    }

    function validateId($id): void
    {
        if (!isset($id)) exceptionNotFound('id');
    }

    function exceptionNotFound($attribute)
    {
        $errors = [$attribute => [__('validation.exists', ['attribute' => $attribute])]];
        throw new HttpResponseException(response(
            new ErrorResponseResource($errors),
            Response::HTTP_NOT_FOUND
        ));
    }

    function exceptionUnique($attribute)
    {
        $errors = [$attribute => [__('validation.unique', ['attribute' => $attribute])]];
        throw new HttpResponseException(response(
            new ErrorResponseResource($errors),
            Response::HTTP_BAD_REQUEST
        ));
    }

    function validateArraySort($filter, $permissibleSort, $defaultSort): string
    {
        return (isset($filter['sort']) && in_array($filter['sort'], $permissibleSort))
            ? $filter['sort']
            : $defaultSort;
    }

    function validateObjectSort($filter, $permissibleSort, $defaultSort): string
    {
        return (isset($filter['sort']) && in_array($filter['sort'], array_keys($permissibleSort)))
            ? $permissibleSort[$filter['sort']]
            : $defaultSort;
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

    function getObjectKeys($object): array
    {
        return array_keys(get_object_vars(json_decode($object)));
    }

    function p_info($data): void
    {
        Log::info($data);
    }

    function p_json(mixed $data): void
    {
        $json = json_decode($data);
        $json = $json == null ? $data : $json;
        Log::info(json_encode($json, JSON_PRETTY_PRINT));
    }
}
