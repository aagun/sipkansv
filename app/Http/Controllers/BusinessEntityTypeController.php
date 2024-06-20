<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BusinessEntityTypeService;
use App\Http\Requests\BusinessEntityTypeCreateRequest;
use App\Http\Requests\BusinessEntityTypeUpdateRequest;

class BusinessEntityTypeController extends Controller
{
    private BusinessEntityTypeService $businessEntityTypeService;

    public function __construct(BusinessEntityTypeService $businessEntityTypeService)
    {
        $this->businessEntityTypeService = $businessEntityTypeService;
    }


    public function create(BusinessEntityTypeCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->businessEntityTypeService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->businessEntityTypeService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(BusinessEntityTypeUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->businessEntityTypeService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->businessEntityTypeService);
        $this->businessEntityTypeService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->businessEntityTypeService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
