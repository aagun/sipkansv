<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageableRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Services\VillageService;
use App\Http\Resources\VillageResource;

class VillageController extends Controller
{
    private VillageService $villageService;

    public function __construct(VillageService $villageService)
    {
        $this->villageService = $villageService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {

        $collection = $this->villageService->search($request->toArray());
        return ok(__('messages.success.retrieve'),
            $collection,
            VillageResource::class,
            true
        );
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->villageService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
