<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use App\Models\Observation;
use App\Models\User;
use Carbon\Carbon;
use App\Models\BusinessEntityType;
use App\Models\Village;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\Province;
use App\Models\Kbli;
use App\Models\BusinessScale;
use App\Models\InvestmentType;
use App\Enums\ComplianceRate;
use App\Enums\ComplianceCategory;
use App\Models\Recommendation;
use App\Models\SubSector;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Promise\Utils;

class ActivityReportSeeder extends Seeder
{
    /**
     * @throws GuzzleException
     */
    public function run(): void
    {
        $client = new Client();
        Storage::deleteDirectory('dokumen-pendukung');
        $promises = [];
        $file = fopen(App::basePath() . '/docs/example.pdf', 'r');
        for ($i = 0; $i < 15; $i++) {
            $sub_sector_id = SubSector::query()->inRandomOrder()->first()->id;
            $multipartData = [
                [
                    'name'     => 'dokumen_pendukung',
                    'contents' => $file,
                    'filename' => "example.pdf",
                    'headers'  => ['Content-Type' => 'application/pdf']
                ],
                [
                    'name'     => 'bap_number',
                    'contents' => fake()->creditCardNumber(),
                ],
                [
                    'name'     => 'activity_id',
                    'contents' => Activity::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'observation_id',
                    'contents' => Observation::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'supervisor_id',
                    'contents' => User::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'inspection_date',
                    'contents' => Carbon::now()->format('Y-m-d'),
                ],
                [
                    'name'     => 'company_name',
                    'contents' => fake()->company(),
                ],
                [
                    'name'     => 'business_entity_type_id',
                    'contents' => BusinessEntityType::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'address',
                    'contents' => fake()->address(),
                ],
                [
                    'name'     => 'village_id',
                    'contents' => Village::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'sub_district_id',
                    'contents' => SubDistrict::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'district_id',
                    'contents' => District::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'province_id',
                    'contents' => Province::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'manager_id',
                    'contents' => User::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'nib',
                    'contents' => fake()->randomNumber(),
                ],
                [
                    'name'     => 'effective_date',
                    'contents' => Carbon::now()->format('Y-m-d'),
                ],
                [
                    'name'     => 'project_code',
                    'contents' => fake()->creditCardNumber(),
                ],
                [
                    'name'     => 'sub_sector_id',
                    'contents' => $sub_sector_id,
                ],
                [
                    'name'     => 'kbli_id',
                    'contents' => Kbli::query()->where("sub_sector_id", $sub_sector_id)->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'business_scale_id',
                    'contents' => BusinessScale::query()->inRandomOrder()->first()->id,
                ],
                [
                    'name'     => 'persetujuan_kesesuaian_ruang',
                    'contents' => 'Y',
                ],
                [
                    'name'     => 'persetujuan_lingkungan',
                    'contents' => 'Y',
                ],
                [
                    'name'     => 'pbg_slf',
                    'contents' => 'Y',
                ],
                [
                    'name'     => 'pernyataan_mandiri',
                    'contents' => 'Y',
                ],
                [
                    'name'     => 'investment_type_id',
                    'contents' => InvestmentType::query()->first()->id,
                ],
                [
                    'name'     => 'latitude',
                    'contents' => fake()->randomFloat(),
                ],
                [
                    'name'     => 'longitude',
                    'contents' => fake()->randomFloat(),
                ],
                [
                    'name'     => 'sertifikat_standar',
                    'contents' => fake()->randomLetter(),
                ],
                [
                    'name'     => 'kepatuhan_teknis',
                    'contents' => 80,
                ],
                [
                    'name'     => 'perizinan_berusaha_atas_kegiatan_usaha',
                    'contents' => 80,
                ],
                [
                    'name'     => 'persyaratan_umum_usaha',
                    'contents' => 80,
                ],
                [
                    'name'     => 'persyaratan_khusus_usaha',
                    'contents' => 80,
                ],
                [
                    'name'     => 'sarana',
                    'contents' => 80,
                ],
                [
                    'name'     => 'organisasi_dan_sdm',
                    'contents' => 80,
                ],
                [
                    'name'     => 'pelayanan',
                    'contents' => 80,
                ],
                [
                    'name'     => 'persyaratan_produk',
                    'contents' => 80,
                ],
                [
                    'name'     => 'sistem_manajemen_usaha',
                    'contents' => 80,
                ],
                [
                    'name'     => 'kepatuhan_administratif',
                    'contents' => 80,
                ],
                [
                    'name'     => 'pelaksanaan_kegiatan_usaha',
                    'contents' => 80,
                ],
                [
                    'name'     => 'riwayat_pengenaan_sanksi',
                    'contents' => 80,
                ],
                [
                    'name'     => 'tingkat_kepatuhan_proyek',
                    'contents' => ComplianceRate::EXCELLENT->value,
                ],
                [
                    'name'     => 'kategory_kepatuhan',
                    'contents' => ComplianceCategory::COMPLIANT->value,
                ],
                [
                    'name'     => 'permasalahan_perusahaan',
                    'contents' => '-',
                ],
                [
                    'name'     => 'hasil_pengawasan',
                    'contents' => 'Baik',
                ],
                [
                    'name'     => 'recommendation_id',
                    'contents' => Recommendation::query()->first()->id,
                ],
            ];

            $promises[] = $client->postAsync(env('API_URL') . "/activity-reports", [
                'multipart' => $multipartData
            ]);
        }

        Utils::settle($promises)->wait();
    }
}
