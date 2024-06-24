<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('docs/districts.csv'), 'r');
        $first_line = true;
        $limit = 20;
        $counter = 1;
        while (($data = fgetcsv($csv_file, 2000, "|")) !== FALSE) {

            if (env('APP_ENV') === 'testing' && $counter === $limit) {
                break;
            }


            if ($first_line || is_null($data[0])) {
                $first_line = false;
                continue;
            }

            District::query()->create([
                "id" => (int)trim($data['0']),
                "name" => trim($data['1']),
                "province_id" => trim($data['2'])
            ]);

            $counter++;
        }

        fclose($csv_file);
    }
}
