<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Response;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function create(RoleRequest $request): Response
    {
        $data = $request->validated();
        $saved = $this->roleService->save($data);
        return created(__('messages.success.created'), $saved);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->roleService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function edit(RoleUpdateRequest $request): Response
    {
        $payload = $request->validated();
        validateUniqueDataByName($payload, $this->roleService);
        $this->roleService->update($payload);
        return ok(__('messages.success.updated'));
    }

    public function delete(?int $id): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->roleService);
        $this->roleService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->roleService);
        $institution = $this->roleService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
