<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\ErrorResponseResource;
use Illuminate\Http\Response;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response(
            new ErrorResponseResource($validator->getMessageBag()),
            Response::HTTP_BAD_REQUEST
        ));

    }
}
