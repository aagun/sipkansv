<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityReportCreateRequest;
use Illuminate\Http\Response;
use App\Services\KbliService;
use App\Services\ActivityReportService;
use Illuminate\Support\Carbon;
use App\Enums\ComplianceRate;
use App\Enums\ComplianceCategory;
use App\Services\AttachmentService;

class ActivityReportController extends Controller
{
    private KbliService $kbliService;
    private AttachmentService $attachmentService;
    private ActivityReportService $activityReportService;

    public function __construct(
        KbliService $kbliService,
        AttachmentService $attachmentService,
        ActivityReportService $activityReportService)
    {
        $this->kbliService = $kbliService;
        $this->attachmentService = $attachmentService;
        $this->activityReportService = $activityReportService;
    }

    public function create(ActivityReportCreateRequest $request): Response
    {
        $payload = $request->validated();

        if (!$this->kbliService->existsBySubSectorId($payload['sub_sector_id'])) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'sub_sector_id'])
            );
        }

        // Validate compliance rate and compliance category
        $complianceRateScore = $this->calcComplianceRateScore($payload);
        $complianceRate = $this->getComplianceRate($complianceRateScore);

        $complianceCategoryScore = $this->calcComplianceCategoryScore($payload, $complianceRateScore);
        $complianceCategory = $this->getComplianceCategory($complianceCategoryScore);

        if ($payload['tingkat_kepatuhan_proyek'] !== $complianceRate->value) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'tingkat_kepatuhan_proyek'])
            );
        }

        if ($payload['kategory_kepatuhan'] !== $complianceCategory->value) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'kategory_kepatuhan'])
            );
        };

        // save the attachment
        $file = $request->file('dokumen_pendukung');
        $filename = $this->composeAttachmentFilename($file);
        $link = $file->storeAs('dokumen-pendukung',  $filename);
        $attachment = $this->attachmentService->save([
            'name' => $filename,
            'link' => $link,
        ]);

        $payload['attachment_id'] = $attachment->id;

        $saved = $this->activityReportService->save($payload);
        return created(__('messages.success.created'), $saved);
    }



    private function composeAttachmentFilename($file): string
    {
        $timestamp = Carbon::now()->format('YmdHis');
        $file_name = preg_replace('/\s+/', '_', $file->getClientOriginalName());
        return $timestamp."_".$file_name;
    }

    private function calcComplianceRateScore(array $request): float
    {
        return ($request['persyaratan_umum_usaha'] +
        $request['persyaratan_khusus_usaha'] +
        $request['sarana'] +
        $request['organisasi_dan_sdm'] +
        $request['pelayanan'] +
        $request['persyaratan_produk'] +
        $request['sistem_manajemen_usaha']) / 7;
    }

    private function getComplianceRate(float $complianceRateScore): ComplianceRate
    {
        if ($complianceRateScore > 70.00) return ComplianceRate::EXCELLENT;

        if ($complianceRateScore >= 50.00 && $complianceRateScore <= 70) return ComplianceRate::SATISFACTORY;

        return ComplianceRate::UNSATISFACTORY;
    }

    private function calcComplianceCategoryScore(array $request, $complianceRateScore): float
    {
        return (
            $request['kepatuhan_teknis'] +
            $request['perizinan_berusaha_atas_kegiatan_usaha'] +
            $request['pelaksanaan_kegiatan_usaha'] +
            $request['riwayat_pengenaan_sanksi'] +
            $complianceRateScore) / 5;
    }

    private function getComplianceCategory(float $complianceCategoryScore): ComplianceCategory
    {
        if ($complianceCategoryScore < 50.00) return ComplianceCategory::NON_COMPLIANT;

        return ComplianceCategory::COMPLIANT;
    }
}
