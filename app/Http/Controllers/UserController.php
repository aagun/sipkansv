<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Response;
use App\Http\Requests\UserUpdateRequest;
use App\Enums\UserStatus;
use App\Http\Requests\PageableRequest;
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
        if (!isset($request['search'])) {
            $request['search'] = ['status' => UserStatus::ACTIVE];
        } else if (isset($request['search']) && !isset($request['search']['status'])) {
            $search = $request[ 'search' ];
            $search[] = ['status' => UserStatus::ACTIVE];
            $request['search'] = $search;
        }

        $collection = $this->userService->search($request->toArray());
        return ok(
            __('messages.success.retrieve'),
            $collection
        );
    }

    public function detail(int $id): Response
    {
        validateId($id);
        validateSoftDeleteDataById($id, $this->userService, UserStatus::ACTIVE->value);
        $user = $this->userService->userDetail($id);
        return ok(__('messages.success.retrieve'), $user);
    }

    public function update(UserUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->userService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(int $id): Response
    {
        validateId($id);
        validateSoftDeleteDataById($id, $this->userService, UserStatus::ACTIVE->value);
        $this->userService->delete($id);
        return ok(__('messages.success.deleted'));
    }
}
