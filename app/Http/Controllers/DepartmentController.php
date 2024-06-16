<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\DepartmentService;
use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Resources\SuccessResponseResource;

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
}
