<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Education;

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
                'description' => 'Sekolah Menegah Atas'
            ],
            [
                'name' => 'S1',
                'description' => 'Strata-I'
            ],
            [
                'name' => 'S2',
                'description' => 'Strata-II'
            ],
            [
                'name' => 'D3',
                'description' => 'Diploma-III'
            ],
            [
                'name' => 'D4',
                'description' => 'Diploma-IV'
            ],
            [
                'name' => 'D5',
                'description' => 'Diploma-V'
            ]
        ];

        foreach ($educations as $education) {
            Education::query()->create($education);
        }
    
    }
}
