<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageableRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Services\SubDistrictService;
use App\Http\Resources\SubDistrictResource;

class SubDistrictController extends Controller
{
    private SubDistrictService $subDistrictService;

    public function __construct(SubDistrictService $subDistrictService)
    {
        $this->subDistrictService = $subDistrictService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {

        $collection = $this->subDistrictService->search($request->toArray());
        return ok(__('messages.success.retrieve'),
            $collection,
            SubDistrictResource::class,
            true
        );
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->subDistrictService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
