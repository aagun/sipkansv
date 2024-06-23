<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityReportCreateRequest;
use Illuminate\Http\Response;
use App\Services\KbliService;
use App\Services\ActivityReportService;

class ActivityReportController extends Controller
{
    private KbliService $kbliService;
    private ActivityReportService $activityReportService;

    public function __construct(
        KbliService $kbliService,
        ActivityReportService $activityReportService)
    {
        $this->kbliService = $kbliService;
        $this->activityReportService = $activityReportService;
    }

    public function create(ActivityReportCreateRequest $request): Response
    {
        if (!$this->kbliService->existsBySubSectorId($request->sub_sector_id)) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'sub_sector_id'])
            );
        }

        $saved = $this->activityReportService->save($request->validated());
        return created(__('messages.success.created'), $saved);
    }
}
