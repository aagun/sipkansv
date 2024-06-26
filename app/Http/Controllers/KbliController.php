<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\KbliService;
use App\Http\Requests\KbliCreateRequest;
use App\Http\Requests\KbliUpdateRequest;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class KbliController extends Controller
{
    private KbliService $kbliService;

    public function __construct(KbliService $kbliService)
    {
        $this->kbliService = $kbliService;
    }

    public function create(KbliCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->kbliService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->kbliService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(KbliUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->kbliService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->kbliService);
        $this->kbliService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->kbliService);
        $institution = $this->kbliService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
