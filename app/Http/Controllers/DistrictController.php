<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageableRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Services\DistrictService;
use App\Http\Resources\DistrictResource;

class DistrictController extends Controller
{
    private DistrictService $districtService;

    public function __construct(DistrictService $districtService)
    {
        $this->districtService = $districtService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->districtService->search($filter);
        return ok(__('messages.success.retrieve'),
            $collection,
            DistrictResource::class,
            true
        );
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->districtService);
        $institution = $this->districtService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
