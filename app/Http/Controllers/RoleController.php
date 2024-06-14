<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\BaseResponseResource;

class RoleController extends Controller
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function createRole(RoleRequest $request): BaseResponseResource
    {
        $data = $request->validated();
        $saved = $this->roleService->save($data);
        return new SuccessResponseResource($saved);
    }
}
