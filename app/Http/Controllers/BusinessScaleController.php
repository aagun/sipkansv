<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BusinessScaleService;
use App\Http\Requests\BusinessScaleCreateRequest;
use App\Http\Requests\BusinessScaleUpdateRequest;

class BusinessScaleController extends Controller
{
    private BusinessScaleService $businessScaleService;

    public function __construct(BusinessScaleService $businessScaleService)
    {
        $this->businessScaleService = $businessScaleService;
    }


    public function create(BusinessScaleCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->businessScaleService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->businessScaleService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(BusinessScaleUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->businessScaleService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->businessScaleService);
        $this->businessScaleService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->businessScaleService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
