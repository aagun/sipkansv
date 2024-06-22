<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\SuccessResponseResource;
use Illuminate\Http\Response;
use App\Http\Requests\UserUpdateRequest;
use App\Enums\UserStatus;
use App\Http\Requests\PageableRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
        return created(
            __('messages.success.created'),
            $saved
        );
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        if (!isset($filter['search']) || !isset($filter['search']['status'])) {
            $filter['search']['status'] = UserStatus::ACTIVE;
        }

        $collection = $this->userService->search($filter);
        return ok(
            __('messages.success.retrieve'),
            $collection,
            UserResource::class,
            true
        );
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
