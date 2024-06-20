<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recommendation;
use Carbon\Carbon;

class RecommendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recommendations = [
            [
                'name' => 'Sangat Baik',
                'description' => 'Telah memenuhi persyaratan perizinan berusaha dan pemenuhan standar pelaksanaan kegiatan usaha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Baik',
                'description' => 'Pembinaan termasuk dalam rangka fasilitasi penyelesaian permasalahan perusahaan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kurang Baik',
                'description' => 'Perbaikan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Buruk',
                'description' => 'Penerapan sanksi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Recommendation::query()->insert($recommendations);
    }
}
