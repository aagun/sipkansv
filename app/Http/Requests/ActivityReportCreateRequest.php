<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Models\Observation;
use App\Models\User;
use App\Models\BusinessEntityType;
use App\Models\Village;
use App\Models\SubDistrict;
use App\Models\District;
use App\Models\Province;
use App\Models\SubSector;
use App\Models\Kbli;
use App\Models\BusinessScale;
use App\Models\InvestmentType;
use App\Enums\ComplianceRate;
use App\Enums\ComplianceCategory;
use App\Models\Recommendation;
use Illuminate\Validation\Rules\File;

class ActivityReportCreateRequest extends BaseRequest
{
    protected function prepareForValidation(): void
    {
        if (isset($this->tingkat_kepatuhan_proyek)) {
            $this->merge([
                'tingkat_kepatuhan_proyek' => ucwords(strtolower($this->tingkat_kepatuhan_proyek))
            ]);
        }
        if (isset($this->kategory_kepatuhan)) {
            $this->merge([
                'kategory_kepatuhan' => ucwords(strtolower($this->kategory_kepatuhan))
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'bap_number' => ['required', 'string'],
            'activity_id' => [
                'required',
                'numeric',
                Rule::exists('activities', 'id')
            ],
            'observation_id' => [
                'required',
                'numeric',
                Rule::exists(Observation::class, 'id')
            ],
            'supervisor_id' => [
                'required',
                'numeric',
                Rule::exists(User::class, 'id')
            ],
            'inspection_date' => [
                'required',
                'date_format:Y-m-d'
            ],
            'company_name' => [
                'required',
                'string'
            ],
            'business_entity_type_id' => [
                'required',
                'numeric',
                Rule::exists(BusinessEntityType::class, 'id')
            ],

            'address' => [
                'required',
                'string'
            ],
            'village_id' => [
                'required',
                Rule::exists(Village::class, 'id')
            ],
            'sub_district_id' => [
                'required',
                Rule::exists(SubDistrict::class, 'id')
            ],
            'district_id' => [
                'required',
                Rule::exists(District::class, 'id')
            ],
            'province_id' => [
                'required',
                Rule::exists(Province::class, 'id')
            ],

            'manager_id' => [
                'required',
                Rule::exists(User::class, 'id')
            ],

            'nib' => [
                'required',
                'string'
            ],
            'effective_date' => [
                'required',
                'date_format:Y-m-d'
            ],
            'project_code' => [
                'required',
                'string'
            ],
            'sub_sector_id' => [
                'required',
                Rule::exists(SubSector::class, 'id')
            ],
            'kbli_id' => [
                'required',
                Rule::exists(Kbli::class, 'id')
            ],
            'business_scale_id' => [
                'required',
                Rule::exists(BusinessScale::class, 'id')
            ],

            'persetujuan_kesesuaian_ruang' => [
                'required',
                'string'
            ],
            'persetujuan_lingkungan' => [
                'required',
                'string'
            ],
            'pbg_slf' => [
                'required',
                'string'
            ],
            'pernyataan_mandiri' => [
                'required',
                'string'
            ],

            'investment_type_id' => [
                'required',
                Rule::exists(InvestmentType::class, 'id')
            ],
            'latitude' => [
                'required',
                'string'
            ],
            'longitude' => [
                'required',
                'string'
            ],
            'sertifikat_standar' => [
                'required',
                'string'
            ],
            'kepatuhan_teknis' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'perizinan_berusaha_atas_kegiatan_usaha' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_umum_usaha' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_khusus_usaha' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'sarana' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'organisasi_dan_sdm' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'pelayanan' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_produk' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'sistem_manajemen_usaha' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'kepatuhan_administratif' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'pelaksanaan_kegiatan_usaha' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'riwayat_pengenaan_sanksi' => [
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'tingkat_kepatuhan_proyek' => [
                'required',
                'string',
                Rule::enum(ComplianceRate::class)
            ],
            'kategory_kepatuhan' => [
                'required',
                'string',
                Rule::enum(ComplianceCategory::class)
            ],

            'permasalahan_perusahaan' => [
                'required',
                'string',
            ],
            'hasil_pengawasan' => [
                'required',
                'string',
            ],
            'dokumen_pendukung' => [
                'required',
                File::types(['pdf'])
                ->max(5 * 1024) // 5MB
            ],
            'recommendation_id' => [
                'required',
                Rule::exists(Recommendation::class, 'id')
            ]
        ];
    }
}
