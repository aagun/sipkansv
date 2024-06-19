<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InvestmentType;
use Carbon\Carbon;

class InvestmentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $investment_types = [
            [
                'name' => 'PMDN',
                'description' => 'PMDN',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'PMA',
                'description' => 'PMA',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        InvestmentType::query()->insert($investment_types);
    }
}
