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
use App\Http\Requests\PageableRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Requests\ActivityReportUpdateRequest;
use Illuminate\Support\Facades\Storage;
use App\Exports\ActivityReportExport;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use App\Services\ObservationService;
use App\Services\DistrictService;

class ActivityReportController extends Controller
{
    private KbliService $kbliService;
    private AttachmentService $attachmentService;

    private DistrictService $districtService;

    private ObservationService $observationService;
    private ActivityReportService $activityReportService;

    public function __construct(
        KbliService           $kbliService,
        DistrictService $districtService,
        ObservationService $observationService,
        AttachmentService     $attachmentService,
        ActivityReportService $activityReportService)
    {
        $this->kbliService = $kbliService;
        $this->attachmentService = $attachmentService;
        $this->observationService = $observationService;
        $this->districtService = $districtService;
        $this->activityReportService = $activityReportService;
    }

    /**
     * @throws ValidationException
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function export(Request $request): Response
    {
        $filter = $request->query();
        $rule = [
            'year' => [
                'sometimes',
                'min:4',
                'max:4',
                'required',
                'date_format:Y',
            ],
            'observation_id' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'district_id' => [
                'sometimes',
                'required',
                'numeric',
            ]
        ];

        $validator = Validator::make($filter, $rule);

        $activityReportExport = new ActivityReportExport(
            $this->districtService,
            $this->observationService,
            $this->activityReportService,
            $validator->getData(),
            'Nama_User_Department'
        );
        $response = $activityReportExport->execute();
        return ok(__('messages.success.retrieve'), $response);
    }

    public function create(ActivityReportCreateRequest $request): Response
    {
        $payload = $request->validated();

        if (!$this->kbliService->existsBySubSectorId($payload[ 'sub_sector_id' ])) {
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

        if (strtolower($payload[ 'tingkat_kepatuhan_proyek' ]) !== strtolower($complianceRate->value)) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'tingkat_kepatuhan_proyek'])
            );
        }

        if (strtolower($payload[ 'kategory_kepatuhan' ]) !== strtolower($complianceCategory->value)) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'kategory_kepatuhan'])
            );
        };

        // save the attachment
        $file = $request->file('dokumen_pendukung');
        $filename = $this->composeAttachmentFilename($file);
        $link = $file->storeAs('dokumen-pendukung', $filename);
        $attachment = $this->attachmentService->save([
            'name' => $filename,
            'link' => $link,
        ]);

        $payload[ 'attachment_id' ] = $attachment->id;

        $saved = $this->activityReportService->save($payload);
        return created(__('messages.success.created'), $saved);
    }

    public function update(ActivityReportUpdateRequest $request): Response
    {
        $payload = $request->validated();

        

        if (isset($payload[ 'sub_sector_id' ]) && !$this->kbliService->existsBySubSectorId($payload[ 'sub_sector_id' ])) {
            return error(
                null,
                __('validation.exists', ['attribute' => 'sub_sector_id'])
            );
        }

        // save the attachment
        if (isset($payload[ 'dokumen_pendukung' ]) && isset($payload[ 'attachment_id' ])) {
            $prev_file = $this->attachmentService->findOne($payload[ 'attachment_id' ])->name;
            Storage::delete($prev_file);

            $file = $request->file('dokumen_pendukung');
            $filename = $this->composeAttachmentFilename($file);
            $link = $file->storeAs('dokumen-pendukung', $filename);

            $this->attachmentService->update([
                'id' => $payload[ 'attachment_id' ],
                'name' => $filename,
                'link' => $link,
            ]);

        }


        unset($payload[ 'sub_sector_id' ]);
        unset($payload[ 'dokumen_pendukung' ]);
        $this->activityReportService->update($payload);

        return ok(__('messages.success.updated'));
    }

    public function detail(?int $id = null): Response
    {
        validateId($id);
        validateExistenceDataById($id, $this->activityReportService);
        $data = $this->activityReportService->detail($id);
        return ok(
            __('messages.success.retrieve'),
            $data
        );
    }

    public function search(PageableRequest $request): Response | ResourceCollection
    {
        $filter = $request->toArray();
        $collection = $this->activityReportService->search($filter);
        return ok(__('messages.success.retrieve'), $collection);
    }

    private function composeAttachmentFilename($file): string
    {
        $timestamp = Carbon::now()->format('YmdHis');
        $file_name = preg_replace('/\s+/', '_', $file->getClientOriginalName());
        return $timestamp . "_" . $file_name;
    }

    private function calcComplianceRateScore(array $request): float
    {
        return ($request[ 'persyaratan_umum_usaha' ] +
                $request[ 'persyaratan_khusus_usaha' ] +
                $request[ 'sarana' ] +
                $request[ 'organisasi_dan_sdm' ] +
                $request[ 'pelayanan' ] +
                $request[ 'persyaratan_produk' ] +
                $request[ 'sistem_manajemen_usaha' ]) / 7;
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
                $request[ 'kepatuhan_teknis' ] +
                $request[ 'perizinan_berusaha_atas_kegiatan_usaha' ] +
                $request[ 'pelaksanaan_kegiatan_usaha' ] +
                $request[ 'riwayat_pengenaan_sanksi' ] +
                $complianceRateScore) / 5;
    }

    private function getComplianceCategory(float $complianceCategoryScore): ComplianceCategory
    {
        if ($complianceCategoryScore < 50.00) return ComplianceCategory::NON_COMPLIANT;

        return ComplianceCategory::COMPLIANT;
    }
}
