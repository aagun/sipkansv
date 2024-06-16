<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentUpdateRequest;

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
        return response(new SuccessResponseResource(null), Response::HTTP_CREATED);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->departmentService->search($filter);
        return response(new SuccessResponseResource($collection), Response::HTTP_OK);
    }

    public function update(DepartmentUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $this->departmentService->update($payload);
        return response(new SuccessResponseResource(null));
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->departmentService);
        $this->departmentService->delete($id);
        return response(new SuccessResponseResource(null));
    }
}
