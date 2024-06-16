<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Request;

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

    public function search(Request $request)
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->departmentService->search($filter);
        return response(new SuccessResponseResource($collection), Response::HTTP_OK);
    }
}
