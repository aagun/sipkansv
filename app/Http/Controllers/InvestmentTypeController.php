<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\InvestmentTypeService;
use App\Http\Requests\InvestmentTypeCreateRequest;
use App\Http\Requests\InvestmentTypeUpdateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\InvestmentTypeResource;

class InvestmentTypeController extends Controller
{
    private InvestmentTypeService $investmentType;

    public function __construct(InvestmentTypeService $investmentType)
    {
        $this->investmentType = $investmentType;
    }

    public function create(InvestmentTypeCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->investmentType->save($payload);
        return created(__('messages.success.created'));
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->investmentType->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            InvestmentTypeResource::class,
            true
        );
    }

    public function update(InvestmentTypeUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->investmentType->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->investmentType);
        $this->investmentType->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $department = $this->investmentType->findOne($id);
        return ok(__('messages.success.retrieve'), $department);
    }
}
