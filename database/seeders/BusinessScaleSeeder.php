<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\BusinessScale;

class BusinessScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub_sectors = [
            [
                'name' => 'Micro',
                'description' => 'Micro',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Kecil',
                'description' => 'Kecil',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Menengah',
                'description' => 'Menengah',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Besar',
                'description' => 'Besar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        BusinessScale::query()->insert($sub_sectors);
    }
}
