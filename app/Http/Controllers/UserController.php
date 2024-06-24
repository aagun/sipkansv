<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\UserCreateRequest;
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
        if (!isset($request['search']) || !isset($request['search']['status'])) {
            $request['search'] = ['status' => UserStatus::ACTIVE];
        }

        $collection = $this->userService->search($request->toArray());
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
        return ok(__('messages.success.retrieve'), $user);
    }

    public function update(UserUpdateRequest $request): Response
    {
        $payload = $request->all();
        $saved = $this->userService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(int $id): Response
    {
        validateExistenceDataById($id, $this->userService);
        $this->userService->delete($id);
        return ok(__('messages.success.deleted'));
    }
}
