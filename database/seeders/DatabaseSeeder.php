<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            EducationSeeder::class,
            UserSeeder::class,
            InvestmentTypeSeeder::class,
            BusinessEntityTypeSeeder::class,
            RecommendationSeeder::class,
            ObservationSeeder::class,
            SubSectorSeeder::class,
            KbliSeeder::class,
            BusinessScaleSeeder::class,
        ]);
    }
}
