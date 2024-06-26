<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;
use Illuminate\Support\Carbon;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'Pengawas Perikanan Ahli Muda',
                'description' => 'Pengawas Perikanan Ahli Muda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawas Perikanan Ahli Pertama',
                'description' => 'Pengawas Perikanan Ahli Pertama',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengolah Data',
                'description' => 'Pengelola Data',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Petugas Pengambil Contoh',
                'description' => 'Petugas Pengambil Contoh',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kepala UPTD Pengawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan',
                'description' => 'Kepala UPTD Pengawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Tenaga Teknis',
                'description' => 'Tenaga Teknis',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Position::query()->insert($positions);
    }
}
