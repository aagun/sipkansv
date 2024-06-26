<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubDistrict;

class SubDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('docs/sub_districts.csv'), 'r');
        $first_line = true;
        $limit = 20;
        $counter = 1;
        while (($data = fgetcsv($csv_file, 2000, "|")) !== FALSE) {
            if (collect(['testing', 'local', 'dev', 'development'])->contains(env('APP_ENV')) && $counter === $limit) {
                break;
            }

            if ($first_line || is_null($data[0])) {
                $first_line = false;
                continue;
            }

            SubDistrict::query()->create([
                "id" => (int)trim($data['0']),
                "name" => trim($data['1']),
                "district_id" => trim($data['2'])
            ]);
            $counter++;
        }

        fclose($csv_file);
    }
}
