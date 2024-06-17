<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\BaseResponseResource;
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

    public function create(RoleRequest $request): BaseResponseResource
    {
        $data = $request->validated();
        $saved = $this->roleService->save($data);
        return new SuccessResponseResource($saved, null, __('messages.success.created'));
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);

        $data = $this->roleService->searchRole($filter);
        return response(new SuccessResponseResource($data, null, __('messages.success.retrieve')));
    }

    public function edit(RoleUpdateRequest $roleRequest, int $id): Response
    {
        $data = $roleRequest->validated();
        validateExistenceDataById($id, $this->roleService);
        $this->roleService->update([...$data, 'id' => $id]);
        return response(new SuccessResponseResource(null, null, __('messages.success.updated')));
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->roleService);
        $this->roleService->delete($id);
        return response(new SuccessResponseResource(null, null, __('messages.success.deleted')));
    }
}
