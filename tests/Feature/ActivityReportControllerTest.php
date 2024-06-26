<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\KbliService;
use App\Services\AttachmentService;
use App\Services\ActivityReportService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Response;
use App\Models\Activity;
use App\Models\User;
use App\Models\Observation;
use Carbon\Carbon;
use App\Models\BusinessEntityType;
use App\Models\Village;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\Province;
use App\Models\SubSector;
use App\Models\Kbli;
use App\Models\BusinessScale;
use App\Models\InvestmentType;
use App\Enums\ComplianceCategory;
use App\Enums\ComplianceRate;
use App\Models\Recommendation;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\ActivityReport;

class ActivityReportControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/activity-reports';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(KbliService::class);
        $this->app->make(AttachmentService::class);
        $this->app->make(ActivityReportService::class);
    }

    public function testCreateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $sub_sector_id = SubSector::query()->first()->id;

        $payload = [
            'bap_number' => '123',
            'activity_id' => Activity::query()->first()->id,
            'observation_id' => Observation::query()->first()->id,
            'supervisor_id' => User::query()->first()->id,
            'inspection_date' => Carbon::now()->format('Y-m-d'),
            'company_name' => 'FAKE COMPANY',
            'business_entity_type_id' => BusinessEntityType::query()->first()->id,

            'address' => 'Fake street',
            'village_id' => Village::query()->first()->id,
            'sub_district_id' => SubDistrict::query()->first()->id,
            'district_id' => District::query()->first()->id,
            'province_id' => Province::query()->first()->id,

            'manager_id' => User::query()->first()->id,

            'nib' => '123',
            'effective_date' => Carbon::now()->format('Y-m-d'),
            'project_code' => 'PROJECT 123',
            'sub_sector_id' => $sub_sector_id,
            'kbli_id' => Kbli::query()->where("sub_sector_id", $sub_sector_id)->first()->id,
            'business_scale_id' => BusinessScale::query()->first()->id,

            'persetujuan_kesesuaian_ruang' => 'Y',
            'persetujuan_lingkungan' => 'Y',
            'pbg_slf' => 'Y',
            'pernyataan_mandiri' => 'Y',

            'investment_type_id' => InvestmentType::query()->first()->id,
            'latitude' => '123',
            'longitude' => '456',
            'sertifikat_standar' => 'PASS',

            'kepatuhan_teknis' => 80,
            'perizinan_berusaha_atas_kegiatan_usaha' => 80,
            'persyaratan_umum_usaha' => 80,
            'persyaratan_khusus_usaha' => 80,
            'sarana' => 80,
            'organisasi_dan_sdm' => 80,
            'pelayanan' => 80,
            'persyaratan_produk' => 80,
            'sistem_manajemen_usaha' => 80,
            'kepatuhan_administratif' => 80,
            'pelaksanaan_kegiatan_usaha' => 80,
            'riwayat_pengenaan_sanksi' => 80,
            'tingkat_kepatuhan_proyek' => ComplianceRate::EXCELLENT->value,
            'kategory_kepatuhan' => ComplianceCategory::COMPLIANT->value,

            'permasalahan_perusahaan' => '-',
            'hasil_pengawasan' => 'Baik',
            'dokumen_pendukung' => UploadedFile::fake()->create('test', 5 * 1024, 'application/pdf'),
            'recommendation_id' => Recommendation::query()->first()->id,
        ];
        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $filter = [];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'message', 'data', 'errors']));
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
    }

    public function testEditSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $activity_report = ActivityReport::query()->inRandomOrder()->first();
        $response = $this->put(self::BASE_ENDPOINT, [
            'id' => $activity_report->id,
            'attachment_id' => $activity_report->attachment_id,
            'dokumen_pendukung' => UploadedFile::fake()->create('update_file.pdf', 1024)
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
    }

    public function testEditNotFound()
    {
        $this->seed(DatabaseSeeder::class);

        $id = 999999;
        $response = $this->put(self::BASE_ENDPOINT, ['id' => $id]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => ["The selected id is invalid."]]);
    }

    public function testEditFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $id = ActivityReport::query()->inRandomOrder()->first()->id;
        $response = $this->put(self::BASE_ENDPOINT, [
            'id' => $id,
            'attachment_id' => 9999999,
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['attachment_id']);
    }

    public function testDetailError()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJsonFragment(['errors' => ['id' => ['The selected id is invalid.']]]);
    }

    public function testDetailSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = ActivityReport::query()->inRandomOrder()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }

}
