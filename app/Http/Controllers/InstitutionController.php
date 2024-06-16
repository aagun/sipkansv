<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\InstitutionCreateRequest;
use App\Services\InstitutionService;
use App\Http\Resources\SuccessResponseResource;

class InstitutionController extends Controller
{
    private InstitutionService $institutionService;

    public function __construct(InstitutionService $institutionService)
    {
        $this->institutionService = $institutionService;
    }


    public function create(InstitutionCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->institutionService->save($payload);

        return response(
            new SuccessResponseResource(null, null, __('messages.success.created')),
            Response::HTTP_CREATED
        );
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->institutionService->search($filter);
        return response(new SuccessResponseResource(
            $collection,
            null,
            __('messages.success.retrieve'))
        );
    }
}
