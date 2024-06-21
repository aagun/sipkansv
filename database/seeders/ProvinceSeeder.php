<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('docs/provinces.csv'), 'r');
        $first_line = true;
        while (($data = fgetcsv($csv_file, 2000, "|")) !== FALSE) {
            if ($first_line || is_null($data[0])) {
                $first_line = false;
                continue;
            }

            Province::query()->create([
                "id" => (int)trim($data['0']),
                "name" => trim($data['1']),
            ]);
        }

        fclose($csv_file);
    }
}
