<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Rank;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ranks = [
            [
                'name' => 'Penata Tk.I',
                'description' => 'Penata Tk.I',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Penata Muda Tk.I',
                'description' => 'Penata Muda Tk.I',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pengatur',
                'description' => 'Pengatur',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Penata Muda',
                'description' => 'Penata Muda',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ];

        Rank::query()->insert($ranks);
    }
}
