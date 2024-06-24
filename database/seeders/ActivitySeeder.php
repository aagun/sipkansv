<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Carbon\Carbon;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'name' => 'Pengawasan Usaha Pemanfaatan Sumber Daya Kelautan Kewenangan Provinsi',
                'description' => 'Pengawasan Usaha Pemanfaatan Sumber Daya Kelautan Kewenangan Provinsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Usaha Penangkapan Ikan Dan/Atau Usaha Pengangkutan Ikan Sampai Dengan 12 Mil Sesuai Kewenangan Provinsi',
                'description' => 'Pengawasan Usaha Penangkapan Ikan Dan/Atau Usaha Pengangkutan Ikan Sampai Dengan 12 Mil Sesuai Kewenangan Provinsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Usaha Pembudidayaan Ikan Di Laut Sampai Dengan 12 Mil Sesuai Kewenangan Provinsi',
                'description' => 'Pengawasan Usaha Pembudidayaan Ikan Di Laut Sampai Dengan 12 Mil Sesuai Kewenangan Provinsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Usaha Penangkapan Ikan Dan/Atau Usaha Pengangkutan Ikan Di Wilayah Sungai, Danau, Waduk, Rawa, Dan Genangan Air Lainnya Sesuai Kewenangan Provinsi',
                'description' => 'Pengawasan Usaha Penangkapan Ikan Dan/Atau Usaha Pengangkutan Ikan Di Wilayah Sungai, Danau, Waduk, Rawa, Dan Genangan Air Lainnya Sesuai Kewenangan Provinsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Usaha Pembudidayaan Ikan Di Wilayah Sungai, Danau, Waduk, Rawa, Dan Genangan Air Lainnya Sesuai Kewenangan Provinsi ',
                'description' => 'Pengawasan Usaha Pembudidayaan Ikan Di Wilayah Sungai, Danau, Waduk, Rawa, Dan Genangan Air Lainnya Sesuai Kewenangan Provinsi ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Usaha Pemasaran Hasil Perikanan Dan/Atau Usaha Pengolahan Hasil Perikanan Sesuai Kewenangan Provinsi',
                'description' => 'Pengawasan Usaha Pemasaran Hasil Perikanan Dan/Atau Usaha Pengolahan Hasil Perikanan Sesuai Kewenangan Provinsi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Activity::query()->insert($activities);
    }
}
