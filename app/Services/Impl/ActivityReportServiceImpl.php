<?php

namespace App\Services\Impl;

use App\Services\ActivityReportService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\ActivityReport;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\ActivityReportStatus;
use Illuminate\Database\Eloquent\Collection;

class ActivityReportServiceImpl implements ActivityReportService
{
    public function exists(int $id): bool
    {
        return ActivityReport::query()->where('id', $id)->exists();
    }

    public function save(array $activityReport): Model | Builder
    {
        return ActivityReport::query()->create($activityReport);
    }

    public function detail(int $id): Model | null | Builder
    {
        $builder = ActivityReport::query();
        $builder = $this->detailSelectTable($builder);
        return $this->searchJoinTable($builder)
            ->where('activity_reports.id', $id)
            ->first();
    }

    public function export(array $filter): Collection
    {
        $builder = ActivityReport::query();
        $builder = $this->exportSelectTable($builder);
        return $this->searchJoinTable($builder)
            ->where('activity_reports.status', ActivityReportStatus::ACTIVE)
            ->when(
                $filter,
                function (Builder $query, array $filter) {
                    if (isset($filter['year'])) {
                        $year = $filter['year'];
                        $query->whereRaw("(activity_reports.inspection_date between
                            str_to_date('{$year}-01-01', '%Y-%m-%d') and
                            str_to_date('{$year}-12-31', '%Y-%m-%d'))"
                        );
                    }

                    if (isset($filter['district_id'])) {
                        $query->where('activity_reports.district_id', $filter['district_id']);
                    }

                    if (isset($filter['observation_id'])) {
                        $query->where('activity_reports.observation_id', $filter['observation_id']);
                    }
                })
            ->orderByDesc('activity_reports.inspection_date')
            ->get();
    }
    public function update(array $activityReport): bool
    {
        $id = $activityReport['id'];
        unset($activityReport['id']);
        return ActivityReport::query()
            ->where('id', $id)
            ->update($activityReport);
    }

    public function search(array $filter): LengthAwarePaginator
    {
        $permissibleSort = $this->searchPermissibleSort();
        $permissibleFilter = $this->searchPermissibleFilter();
        $search = $filter['search'];
        $sort = validateObjectSort($filter, $permissibleSort, 'activity_reports.inspection_date');
        $order = isset($filter['sort']) ? $filter['order'] : 'desc';

        $builder = ActivityReport::query();
        $builder = $this->searchSelectTable($builder);
        return $this->searchJoinTable($builder)
            ->when(
                $search,
                function (Builder $query, array $search) use($permissibleFilter) {
                    $this->searchFilter($query, $search, $permissibleFilter);
                })
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchFilter(Builder $query, $search, $permissibleFilter): void
    {
        foreach (array_keys($search) as $key) {

            if (isset($search[$key]) && $key === 'year') {
                $query->whereRaw("({$permissibleFilter[$key]} between
                    str_to_date('{$search[ $key ]}-01-01', '%Y-%m-%d') and
                    str_to_date('{$search[ $key ]}-12-31', '%Y-%m-%d'))"
                );
                continue;
            }

            if (isset($search[$key])) {
                $query->where($permissibleFilter[$key], $search[$key]);
            }
        }
    }

    private function detailSelectTable(Builder $query): Builder
    {
        return $query
            ->selectRaw(
                "
                activity_reports.id as activity_report_id,
                activity_reports.bap_number,
                activities.id as activity_id,
                activities.name as activity_name,
                observations.id as observation_id,
                observations.name as observation_name,
                supervisors.id as supervisor_id,
                supervisors.name as supervisor_name,
                activity_reports.inspection_date,
                activity_reports.company_name,
                business_entity_types.id as business_entity_type_id,
                business_entity_types.name as business_entity_type_name,
                activity_reports.address,
                villages.id as village_id,
                villages.name as village_name,
                sub_districts.id as sub_district_id,
                sub_districts.name as sub_district_name,
                districts.id as district_id,
                districts.name as district_name,
                provinces.id as province_id,
                provinces.name as province,
                managers.id as manager_id,
                managers.name as manager_name,
                positions.id as manager_position_id,
                positions.name as manager_position_name,
                managers.phone as manager_phone,
                activity_reports.nib,
                activity_reports.effective_date,
                activity_reports.project_code,
                sub_sectors.id as sub_sector_id,
                sub_sectors.name as sub_sector_name,
                kblis.id as kbli_id,
                kblis.name as kbli_name,
                business_scales.id as business_scale_id,
                business_scales.name as business_scale_name,
                activity_reports.persetujuan_kesesuaian_ruang,
                activity_reports.persetujuan_lingkungan,
                activity_reports.pbg_slf,
                activity_reports.pernyataan_mandiri,
                activity_reports.sertifikat_standar,
                investment_types.id as investment_type_id,
                investment_types.name as investment_type_name,
                activity_reports.latitude,
                activity_reports.longitude,
                activity_reports.perizinan_berusaha_atas_kegiatan_usaha,
                activity_reports.persyaratan_umum_usaha,
                activity_reports.persyaratan_khusus_usaha,
                activity_reports.sarana,
                activity_reports.organisasi_dan_sdm,
                activity_reports.pelayanan,
                activity_reports.persyaratan_produk,
                activity_reports.sistem_manajemen_usaha,
                activity_reports.pelaksanaan_kegiatan_usaha,
                activity_reports.riwayat_pengenaan_sanksi,
                activity_reports.tingkat_kepatuhan_proyek,
                activity_reports.kategory_kepatuhan,
                activity_reports.permasalahan_perusahaan,
                activity_reports.hasil_pengawasan,
                attachments.id as attachment_id,
                attachments.name as attachment_name,
                attachments.link as attachment_link,
                recommendations.id as recommendation_id,
                recommendations.name as recommendation_name
            ");
    }

    private function exportSelectTable(Builder $query): Builder
    {
        return $query
            ->selectRaw(
                "activity_reports.bap_number,
                activities.name as activity,
                observations.name as observation,
                supervisors.name as supervisor_name,
                activity_reports.inspection_date,
                activity_reports.company_name,
                business_entity_types.name as business_entity_type,
                activity_reports.address,
                villages.name as village,
                sub_districts.name as sub_district,
                districts.name as district,
                provinces.name as province,
                managers.name as manager_name,
                positions.name as manager_position,
                managers.phone as manager_phone,
                activity_reports.nib,
                activity_reports.effective_date,
                activity_reports.project_code,
                sub_sectors.name as sub_sector,
                kblis.name as kbli,
                business_scales.name as business_scale,
                activity_reports.persetujuan_kesesuaian_ruang,
                activity_reports.persetujuan_lingkungan,
                activity_reports.pbg_slf,
                activity_reports.pernyataan_mandiri,
                activity_reports.sertifikat_standar,
                investment_types.name as investment_type,
                activity_reports.latitude,
                activity_reports.longitude,
                activity_reports.perizinan_berusaha_atas_kegiatan_usaha,
                FORMAT(((activity_reports.persyaratan_umum_usaha +
                    activity_reports.persyaratan_khusus_usaha +
                    activity_reports.sarana +
                    activity_reports.organisasi_dan_sdm +
                    activity_reports.pelayanan +
                    activity_reports.persyaratan_produk +
                    activity_reports.sistem_manajemen_usaha)/6), 2)
                AS standar_pelaksanaan_kegiatan_usaha,
                activity_reports.pelaksanaan_kegiatan_usaha,
                activity_reports.riwayat_pengenaan_sanksi,
                activity_reports.tingkat_kepatuhan_proyek,
                activity_reports.kategory_kepatuhan,
                recommendations.name as recommendation
            ");
    }

    private function searchSelectTable(Builder $query): Builder
    {
        return $query
            ->selectRaw(
                "
                activity_reports.id as activity_report_id,
                activity_reports.bap_number,
                activities.name as activity,
                observations.name as observation,
                supervisors.name as supervisor_name,
                activity_reports.inspection_date,
                activity_reports.company_name,
                business_entity_types.name as business_entity_type,
                activity_reports.address,
                villages.name as village,
                sub_districts.name as sub_district,
                districts.name as district,
                provinces.name as province,
                managers.name as manager_name,
                positions.name as manager_position,
                managers.phone as manager_phone,
                activity_reports.nib,
                activity_reports.effective_date,
                activity_reports.project_code,
                sub_sectors.name as sub_sector,
                kblis.name as kbli,
                business_scales.name as business_scale,
                activity_reports.persetujuan_kesesuaian_ruang,
                activity_reports.persetujuan_lingkungan,
                activity_reports.pbg_slf,
                activity_reports.pernyataan_mandiri,
                activity_reports.sertifikat_standar,
                investment_types.name as investment_type,
                activity_reports.latitude,
                activity_reports.longitude,
                activity_reports.perizinan_berusaha_atas_kegiatan_usaha,
                FORMAT(((activity_reports.persyaratan_umum_usaha +
                    activity_reports.persyaratan_khusus_usaha +
                    activity_reports.sarana +
                    activity_reports.organisasi_dan_sdm +
                    activity_reports.pelayanan +
                    activity_reports.persyaratan_produk +
                    activity_reports.sistem_manajemen_usaha)/6), 2)
                AS standar_pelaksanaan_kegiatan_usaha,
                activity_reports.pelaksanaan_kegiatan_usaha,
                activity_reports.riwayat_pengenaan_sanksi,
                activity_reports.tingkat_kepatuhan_proyek,
                activity_reports.kategory_kepatuhan,
                activity_reports.permasalahan_perusahaan,
                activity_reports.hasil_pengawasan,
                attachments.name as attachment_name,
                attachments.link as attachment_link,
                recommendations.name as recommendation
            ");
    }

    private function searchJoinTable(Builder $query): Builder
    {
        return $query
            ->leftJoin('activities', 'activities.id', '=', 'activity_reports.activity_id')
            ->leftJoin('observations', 'observations.id', '=', 'activity_reports.observation_id')
            ->leftJoin('users as supervisors', 'supervisors.id', '=', 'activity_reports.supervisor_id')
            ->leftJoin('business_entity_types', 'business_entity_types.id', '=', 'activity_reports.business_entity_type_id')
            ->leftJoin('villages', 'villages.id', '=', 'activity_reports.village_id')
            ->leftJoin('sub_districts', 'sub_districts.id', '=', 'activity_reports.sub_district_id')
            ->leftJoin('districts', 'districts.id', '=', 'activity_reports.district_id')
            ->leftJoin('provinces', 'provinces.id', '=', 'activity_reports.province_id')
            ->leftJoin('users as managers', 'managers.id', '=', 'activity_reports.manager_id')
            ->leftJoin('positions', 'positions.id', '=', 'managers.position_id')
            ->leftJoin('kblis', 'kblis.id', '=', 'activity_reports.kbli_id')
            ->leftJoin('sub_sectors', 'sub_sectors.id', '=', 'kblis.sub_sector_id')
            ->leftJoin('business_scales', 'business_scales.id', '=', 'activity_reports.business_scale_id')
            ->leftJoin('investment_types', 'investment_types.id', '=', 'activity_reports.investment_type_id')
            ->leftJoin('attachments', 'attachments.id', '=', 'activity_reports.attachment_id')
            ->leftJoin('recommendations', 'recommendations.id', '=', 'activity_reports.recommendation_id');
    }

    private function searchPermissibleFilter(): array
    {
        return [
            'year' => 'activity_reports.inspection_date',
            'status' => 'activity_reports.status',
            'district_id' => 'activity_reports.district_id',

            'bap_number' => 'activity_reports.bap_number',
            'activity_id' => 'activity_reports.activity_id',
            'observation_id' => 'activity_reports.observation_id',
            'supervisor_id' => 'supervisors.supervisor_id',
            'company_name' => 'activity_reports.company_name',
            'business_entity_type_id' => 'activity_reports.business_entity_type_id',

            'manager_id' => 'managers.manager_id',

            'nib' => 'activity_reports.nib',
            'project_code' => 'activity_reports.project_code',
            'kbli_id' => 'activity_reports.kbli_id',
            'business_scale_id' => 'activity_reports.business_scale_id',

            'tingkat_kepatuhan_proyek' => 'activity_reports.business_scale_id',
            'kategory_kepatuhan' => 'activity_reports.kategory_kepatuhan',
        ];
    }

    private function searchPermissibleSort(): array
    {
        return [
            'bap_number' => 'activity_reports.bap_number',
            'activity_id' => 'activity_reports.activity_id',
            'observation_id' => 'activity_reports.observation_id',
            'supervisor_id' => 'activity_reports.supervisor_id',
            'company_name' => 'activity_reports.company_name',
            'business_entity_type_id' => 'activity_reports.business_entity_type_id',

            'sub_district_id' => 'activity_reports.sub_district_id',
            'district_id' => 'activity_reports.district_id',
            'manager_id' => 'activity_reports.manager_id',

            'nib' => 'activity_reports.nib',
            'project_code' => 'activity_reports.project_code',
            'kbli_id' => 'activity_reports.kbli_id',
            'business_scale_id' => 'activity_reports.business_scale_id',

            'tingkat_kepatuhan_proyek' => 'activity_reports.business_scale_id',
            'kategory_kepatuhan' => 'activity_reports.kategory_kepatuhan',
        ];
    }

}
