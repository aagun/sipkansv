<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\GradeLevel;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grade_levels = [
            [
                'name' => 'II/A',
                'description' => 'Golongan II/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'II/B',
                'description' => 'Golongan II/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'II/C',
                'description' => 'Golongan II/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'II/D',
                'description' => 'Golongan II/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'III/A',
                'description' => 'Golongan III/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'III/B',
                'description' => 'Golongan III/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'III/C',
                'description' => 'Golongan III/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'III/D',
                'description' => 'Golongan III/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'IV/A',
                'description' => 'Golongan IV/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'IV/B',
                'description' => 'Golongan IV/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'IV/C',
                'description' => 'Golongan IV/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'IV/D',
                'description' => 'Golongan IV/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        GradeLevel::query()->insert($grade_levels);
    }
}
