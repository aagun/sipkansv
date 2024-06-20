<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\SubSector;

class SubSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub_sectors = [
            [
                'name' => 'Penangkapan Dan Pengangkutan Ikan',
                'description' => 'Penangkapan Dan Pengangkutan Ikan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Bidang Pembudidayaan Ikan',
                'description' => 'Bidang Pembudidayaan Ikan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengolahan Hasil Perikanan',
                'description' => 'Pengolahan Hasil Perikanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengelolaan Ruang Laut',
                'description' => 'Pengelolaan Ruang Laut',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pemasaran Hasil Perikanan',
                'description' => 'Pemasaran Hasil Perikanan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        SubSector::query()->insert($sub_sectors);
    }
}
