<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SubSectorService;
use Illuminate\Http\Response;
use App\Http\Requests\SubSectorCreateRequest;
use App\Http\Requests\SubSectorUpdateRequest;

class SubSectorController extends Controller
{
    private SubSectorService $subSectorService;

    public function __construct(SubSectorService $subSectorService)
    {
        $this->subSectorService = $subSectorService;
    }


    public function create(SubSectorCreateRequest $request): Response
    {
        $payload = $request->validated();
        $rank = $this->subSectorService->save($payload);
        return created(__('messages.success.created'), $rank);
    }

    public function search(Request $request): Response
    {
        $filter = $request->only(['name', 'description']);
        $collection = $this->subSectorService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function update(SubSectorUpdateRequest $request): Response
    {
        $payload = $request->validated();
        $saved = $this->subSectorService->update($payload);
        return ok(__('messages.success.updated'), $saved);
    }

    public function delete(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->subSectorService);
        $this->subSectorService->delete($id);
        return ok(__('messages.success.deleted'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->subSectorService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
