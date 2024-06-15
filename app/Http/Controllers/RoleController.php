<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use App\Http\Resources\SuccessResponseResource;
use App\Http\Resources\BaseResponseResource;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Http\Resources\ErrorResponseResource;
use App\Http\Requests\RoleUpdateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    public function editRole(RoleUpdateRequest $roleRequest, int $id): Response
    {
        $data = $roleRequest->validated();

        if (!$this->roleService->exists($id)) {
            $errors = ['id' => ["The id $id does not exist"]];
            throw new HttpResponseException(response(
                new ErrorResponseResource($errors),
            Response::HTTP_NOT_FOUND)
            );
        }

        $this->roleService->update([...$data, 'id' => $id]);
        return response(new SuccessResponseResource(null));
    }

    public function deleteRole(int $id): Response
    {
        if (!$this->roleService->exists($id)) {
            $errors = ['id' => ["The id $id does not exist"]];
            throw new HttpResponseException(response(
                new ErrorResponseResource($errors),
            Response::HTTP_NOT_FOUND)
            );
        }

        $this->roleService->delete($id);
        return response(new SuccessResponseResource(null));
    }
}
