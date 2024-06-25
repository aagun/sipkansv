<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\PageableRequest;

class DepartmentController extends Controller
{
    private DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function create(DepartmentCreateRequest $request): Response
    {
        $payload = $request->validated();
        $this->departmentService->save($payload);
        return created(__('messages.success.created'));
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->departmentService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(DepartmentUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->departmentService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->departmentService);
        $this->departmentService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->departmentService);
        $department = $this->departmentService->findOne($id);
        return ok(__('messages.success.retrieve'), $department);
    }
}
