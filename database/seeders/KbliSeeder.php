<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kbli;
use App\Models\SubSector;

class KbliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv_file = fopen(base_path('docs/data-kbli.csv'), 'r');
        $first_line = true;
        while (($data = fgetcsv($csv_file, 2000, "|")) !== FALSE) {
            if ($first_line) {
                $first_line = false;
                continue;
            }

            $kbli = [
                "code" => (int)trim($data['0']),
                "name" => trim($data['1']),
                "sub_sector_id" => SubSector::query()->where('name', trim($data['2']))->first()->id,
            ];

            Kbli::query()->create($kbli);
        }

        fclose($csv_file);
    }
}
