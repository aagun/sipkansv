<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BusinessEntityType;

class BusinessEntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $business_entity_type = [
            [
                'name' => 'Perseorangan',
                'description' => 'Perseorangan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Badan Usaha',
                'description' => 'Badan Usaha',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        BusinessEntityType::query()->insert($business_entity_type);
    }
}
