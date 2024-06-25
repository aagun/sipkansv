<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageableRequest;
use Illuminate\Http\Response;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Services\SubDistrictService;

class SubDistrictController extends Controller
{
    private SubDistrictService $subDistrictService;

    public function __construct(SubDistrictService $subDistrictService)
    {
        $this->subDistrictService = $subDistrictService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {

        $filter = $request->toArray();
        $collection = $this->subDistrictService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->subDistrictService);
        $institution = $this->subDistrictService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
