<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Education;
use Carbon\Carbon;

class EducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educations = [
            [
                'name' => 'SMA',
                'description' => 'Sekolah Menegah Atas',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'S1',
                'description' => 'Strata-I',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'S2',
                'description' => 'Strata-II',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'D3',
                'description' => 'Diploma-III',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'D4',
                'description' => 'Diploma-IV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'D5',
                'description' => 'Diploma-V',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        Education::query()->insert($educations);

    }
}
