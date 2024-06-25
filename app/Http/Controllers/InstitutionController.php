<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Http\Requests\InstitutionCreateRequest;
use App\Services\InstitutionService;
use App\Http\Requests\InstitutionUpdateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\InstitutionResource;

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
        $saved = $this->institutionService->save($payload);
        return created(__('messages.success.created'), $saved);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->institutionService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            InstitutionResource::class,
            true
        );
    }

    public function update(InstitutionUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->institutionService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->institutionService);
        $this->institutionService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->institutionService);
        $institution = $this->institutionService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
