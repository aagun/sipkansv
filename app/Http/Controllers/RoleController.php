<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\BaseResponseResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

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

    public function searchRole(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);

        $data = $this->roleService->searchRole($filter);
        return response(new SuccessResponseResource($data));
    }
}
