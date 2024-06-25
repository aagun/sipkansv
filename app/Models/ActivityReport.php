<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityReport extends Model
{
    use HasFactory;

    protected $table = 'activity_reports';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    protected $fillable = [
        'bap_number',
        'activity_id',
        'observation_id',
        'supervisor_id',
        'inspection_date',
        'company_name',
        'business_entity_type_id',

        'address',
        'village_id',
        'sub_district_id',
        'district_id',
        'province_id',

        'manager_id',

        'nib',
        'effective_date',
        'project_code',
        'kbli_id',
        'business_scale_id',

        'persetujuan_kesesuaian_ruang',
        'persetujuan_lingkungan',
        'pbg_slf',
        'pernyataan_mandiri',

        'investment_type_id',
        'latitude',
        'longitude',
        'sertifikat_standar',

        'kepatuhan_teknis',
        'perizinan_berusaha_atas_kegiatan_usaha',
        'persyaratan_umum_usaha',
        'persyaratan_khusus_usaha',
        'sarana',
        'organisasi_dan_sdm',
        'pelayanan',
        'persyaratan_produk',
        'sistem_manajemen_usaha',

        'kepatuhan_administratif',
        'pelaksanaan_kegiatan_usaha',
        'riwayat_pengenaan_sanksi',

        'tingkat_kepatuhan_proyek',
        'kategory_kepatuhan',

        'permasalahan_perusahaan',
        'hasil_pengawasan',
        'attachment_id',
        'recommendation_id',
    ];



    public function activity(): BelongsTo
    {
        return $this->belongsTo(
            Activity::class,
            'activity_id',
            'id'
        );
    }

    public function observation(): BelongsTo
    {
        return $this->belongsTo(
            Observation::class,
            'observation_id',
            'id'
        );
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'supervisor_id',
            'id'
        );
    }

    public function businessEntityType(): BelongsTo
    {
        return $this->belongsTo(
            BusinessEntityType::class,
            'business_entity_type_id',
            'id'
        );
    }
    public function village(): BelongsTo
    {
        return $this->belongsTo(
            Village::class,
            'village_id',
            'id'
        );
    }

    public function subDistrict(): BelongsTo
    {
        return $this->belongsTo(
            SubDistrict::class,
            'sub_district_id',
            'id'
        );
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(
            District::class,
            'district_id',
            'id'
        );
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(
            Province::class,
            'province_id',
            'id'
        );
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'manager_id',
            'id'
        );
    }

    public function kbli(): BelongsTo
    {
        return $this->belongsTo(
            Kbli::class,
            'kbli_id',
            'id'
        );
    }

    public function businessScale(): BelongsTo
    {
        return $this->belongsTo(
            BusinessScale::class,
            'business_scale_id',
            'id'
        );
    }

    public function investmentType(): BelongsTo
    {
        return $this->belongsTo(
            InvestmentType::class,
            'investment_type_id',
            'id'
        );
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(
            Attachment::class,
            'attachment_id',
            'id'
        );
    }

    public function recommendation(): BelongsTo
    {
        return $this->belongsTo(
            Recommendation::class,
            'recommendation_id',
            'id'
        );
    }

}
