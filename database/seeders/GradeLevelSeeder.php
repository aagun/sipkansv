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
                'name' => '2A',
                'description' => 'II/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '2B',
                'description' => 'II/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '2C',
                'description' => 'II/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '2D',
                'description' => 'II/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '3A',
                'description' => 'III/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '3B',
                'description' => 'III/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '3C',
                'description' => 'III/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '3D',
                'description' => 'III/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '4A',
                'description' => 'IV/A',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '4B',
                'description' => 'IV/B',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '4C',
                'description' => 'IV/C',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => '4D',
                'description' => 'IV/D',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        GradeLevel::query()->insert($grade_levels);
    }
}
