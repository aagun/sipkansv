<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Village;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('docs/villages.csv'), 'r');
        $first_line = true;
        $limit = 20;
        $counter = 1;
        while (($data = fgetcsv($csv_file, 2000, "|")) !== FALSE) {
            if (preg_match('/^,{10}$/', $data[0])) break;

            if (collect(['testing', 'local', 'dev', 'development'])->contains(env('APP_ENV')) && $counter === $limit) break;

            if ($first_line || is_null($data[0])) {
                $first_line = false;
                continue;
            }

            if (count($data) === 1) {
                $data = explode("|", $data[0]);
            }

            Village::query()->create([
                "id" => (int)trim($data['0']),
                "name" => trim($data['1']),
                "sub_district_id" => trim(substr($data['2'], 0, 6))
            ]);
            $counter++;
        }

        fclose($csv_file);
    }
}
