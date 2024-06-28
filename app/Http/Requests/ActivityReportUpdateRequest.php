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
use Illuminate\Validation\Rules\File;
use App\Models\Recommendation;
use App\Models\Activity;
use App\Models\ActivityReport;
use App\Models\Attachment;

class ActivityReportUpdateRequest extends BaseRequest
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
            'id' => [
                'nullable',
                'numeric',
                Rule::exists(ActivityReport::class, 'id')
            ],
            'bap_number' => [
                'sometimes',
                'required',
                'string'
            ],
            'activity_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(Activity::class, 'id')
            ],
            'observation_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(Observation::class, 'id')
            ],
            'supervisor_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(User::class, 'id')
            ],
            'inspection_date' => [
                'sometimes',
                'required',
                'date_format:Y-m-d'
            ],
            'company_name' => [
                'sometimes',
                'required',
                'string'
            ],
            'business_entity_type_id' => [
                'sometimes',
                'required',
                'numeric',
                Rule::exists(BusinessEntityType::class, 'id')
            ],

            'address' => [
                'sometimes',
                'required',
                'string'
            ],
            'village_id' => [
                'sometimes',
                'required',
                Rule::exists(Village::class, 'id')
            ],
            'sub_district_id' => [
                'sometimes',
                'required',
                Rule::exists(SubDistrict::class, 'id')
            ],
            'district_id' => [
                'sometimes',
                'required',
                Rule::exists(District::class, 'id')
            ],
            'province_id' => [
                'sometimes',
                'required',
                Rule::exists(Province::class, 'id')
            ],

            'manager_id' => [
                'sometimes',
                'required',
                Rule::exists(User::class, 'id')
            ],

            'nib' => [
                'sometimes',
                'required',
                'string'
            ],
            'effective_date' => [
                'sometimes',
                'required',
                'date_format:Y-m-d'
            ],
            'project_code' => [
                'sometimes',
                'required',
                'string'
            ],
            'sub_sector_id' => [
                'sometimes',
                'required',
                Rule::exists(SubSector::class, 'id')
            ],
            'kbli_id' => [
                'sometimes',
                'required',
                Rule::exists(Kbli::class, 'id')
            ],
            'business_scale_id' => [
                'sometimes',
                'required',
                Rule::exists(BusinessScale::class, 'id')
            ],

            'persetujuan_kesesuaian_ruang' => [
                'sometimes',
                'required',
                'string'
            ],
            'persetujuan_lingkungan' => [
                'sometimes',
                'required',
                'string'
            ],
            'pbg_slf' => [
                'sometimes',
                'required',
                'string'
            ],
            'pernyataan_mandiri' => [
                'sometimes',
                'required',
                'string'
            ],

            'investment_type_id' => [
                'sometimes',
                'required',
                Rule::exists(InvestmentType::class, 'id')
            ],
            'latitude' => [
                'sometimes',
                'required',
                'string'
            ],
            'longitude' => [
                'sometimes',
                'required',
                'string'
            ],
            'sertifikat_standar' => [
                'sometimes',
                'required',
                'string'
            ],
            'kepatuhan_teknis' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'perizinan_berusaha_atas_kegiatan_usaha' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_umum_usaha' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_khusus_usaha' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'sarana' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'organisasi_dan_sdm' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'pelayanan' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'persyaratan_produk' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'sistem_manajemen_usaha' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'kepatuhan_administratif' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'pelaksanaan_kegiatan_usaha' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'riwayat_pengenaan_sanksi' => [
                'sometimes',
                'required',
                'numeric',
                'min:0',
                'max:100'
            ],
            'tingkat_kepatuhan_proyek' => [
                'sometimes',
                'required',
                'string',
                Rule::enum(ComplianceRate::class)
            ],
            'kategory_kepatuhan' => [
                'sometimes',
                'required',
                'string',
                Rule::enum(ComplianceCategory::class)
            ],

            'permasalahan_perusahaan' => [
                'sometimes',
                'required',
                'string',
            ],
            'hasil_pengawasan' => [
                'sometimes',
                'required',
                'string',
            ],
            'attachment_id' => [
                'sometimes',
                'required',
                Rule::exists(Attachment::class, 'id')
            ],
            'dokumen_pendukung' => [
                'sometimes',
                'required',
                File::types(['pdf'])
                    ->max(5 * 1024) // 5MB
            ],
            'recommendation_id' => [
                'sometimes',
                'required',
                Rule::exists(Recommendation::class, 'id')
            ]
        ];
    }
}
