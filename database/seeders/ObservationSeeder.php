<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Observation;

class ObservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $observations = [
            [
                'name' => 'Pengawasan Rutin',
                'description' => 'Pengawasan Rutin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengawasan Insidental',
                'description' => 'Pengawasan Insidental',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Patroli/Perondaan',
                'description' => 'Patroli/Perondaan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Observation::query()->insert($observations);
    }
}
