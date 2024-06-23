<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'sub_sector_id',
        'kbli_id',
        'business_scale_id',

        'persetujuan_kesesuaian_ruang',
        'persetujuan_lingkungan',
        'pbg_slf',
        'pernyataan_mandiri',

        'sertifikat_standar',
        'investment_type_id',
        'latitude',
        'longitude',
        'sertifikat_standar',

        'kepatuhan_teknis',
        'perizinan_berusaha_atas_kegiatan_usaha',
        'standar_pelaksanaan_kegiatan_usaha',
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
        'dokumen_pendukung',
        'recommendation_id',
    ];

}
