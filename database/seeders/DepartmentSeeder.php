<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'name' => 'UPTD PSDKPWS',
                'description' => 'Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'UPTD PSDKPWU',
                'description' => 'Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Bidang PSDKP',
                'description' => 'Bidang Pengawasan Sumber Daya Kelautan dan Perikanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Department::query()->insert($departments);
    }
}
