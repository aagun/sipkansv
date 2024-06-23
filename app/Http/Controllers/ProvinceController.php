<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Services\ProvinceService;
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
{
    private ProvinceService $provinceService;

    public function __construct(ProvinceService $provinceService)
    {
        $this->provinceService = $provinceService;
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {

        $filter = $request->toArray();
        $collection = $this->provinceService->search($filter);
        return ok(__('messages.success.retrieve'),
            $collection,
            ProvinceResource::class,
            true
        );
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        $institution = $this->provinceService->findOne($id);
        return ok(__('messages.success.retrieve'), $institution);
    }
}
