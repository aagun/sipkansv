<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Requests\RoleUpdateRequest;

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

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);

        $data = $this->roleService->searchRole($filter);
        return ok(__('messages.success.retrieve'), $data);
    }

    public function edit(RoleUpdateRequest $roleRequest, int $id): Response
    {
        $data = $roleRequest->validated();
        validateExistenceDataById($id, $this->roleService);
        $this->roleService->update([...$data, 'id' => $id]);
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
        $institution = $this->roleService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
