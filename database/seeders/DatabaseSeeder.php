<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PositionSeeder::class,
            RankSeeder::class,
            DepartmentSeeder::class,
            InstitutionSeeder::class,
            GradeLevelSeeder::class,
            UserSeeder::class
        ]);
    }
}
