<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Response;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Enums\UserStatus;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create(UserCreateRequest $request): Response
    {
        $payload = $request->all();
        $saved = $this->userService->save($payload);
        return response(
            new SuccessResponseResource(
                $saved,
                null,
                __('messages.success.created')
            ),
            Response::HTTP_CREATED
        );
    }

    public function search(Request $request): Response
    {
        $filter = $request->only([
            'name',
            'nip',
            'status',
            'position_id',
            'education_id',
            'rank_id',
            'institution_id',
            'grade_level_id',
            'department_id',
        ]);

        if (!isset($filter) || !isset($filter['status'])) {
            $filter['status'] = UserStatus::ACTIVE;
        }

        $collection = $this->userService->search($filter);
        return response(new SuccessResponseResource(
            $collection,
            null,
            __('messages.success.retrieve')
        ));
    }

    public function detail(int $id): Response
    {
        $user = $this->userService->userDetail($id);
        return response(new SuccessResponseResource(
            $user,
            null,
            __('messages.success.retrieve')
        ));
    }

    public function update(UserUpdateRequest $request): Response
    {
        $payload = $request->all();
        $saved = $this->userService->update($payload);
        return response(
            new SuccessResponseResource(
                $saved,
                null,
                __('messages.success.updated')
            ),
            Response::HTTP_CREATED
        );
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->userService);
        $this->userService->delete($id);
        return response(
            new SuccessResponseResource(
                null,
                null,
                __('messages.success.deleted')
            )
        );
    }
}
