<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Institution;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $institutions = [
            'name' => 'DKPP JABAR',
            'description' => 'Dinas Kelautan dan Perikanan Provinsi Jawa Barat',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        Institution::query()->insert($institutions);
    }
}
