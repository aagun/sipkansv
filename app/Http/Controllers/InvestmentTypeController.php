<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\InvestmentTypeService;
use App\Http\Requests\InvestmentTypeCreateRequest;
use App\Http\Requests\InvestmentTypeUpdateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InvestmentTypeController extends Controller
{
    private InvestmentTypeService $investmentTypeService;

    public function __construct(InvestmentTypeService $investmentTypeService)
    {
        $this->investmentTypeService = $investmentTypeService;
    }

    public function create(InvestmentTypeCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->investmentTypeService->save($payload);
        return created(__('messages.success.created'));
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->investmentTypeService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(InvestmentTypeUpdateRequest $request): Response
    {
        $payload = $request->validated();
        validateUniqueDataByName($payload, $this->investmentTypeService);
        $this->investmentTypeService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->investmentTypeService);
        $this->investmentTypeService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->investmentTypeService);
        $department = $this->investmentTypeService->findOne($id);
        return ok(__('messages.success.retrieve'), $department);
    }
}
