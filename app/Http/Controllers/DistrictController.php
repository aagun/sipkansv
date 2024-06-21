<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageableRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProvinceResource;
use App\Services\DistrictService;

class DistrictController extends Controller
{
    private DistrictService $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {

        $collection = $this->districtService->search($request->toArray());
        return ok(__('messages.success.retrieve'),
            $collection,
            ProvinceResource::class,
            true
        );
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->districtService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
