<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use App\Services\InstitutionService;

class InstitutionServiceTest extends TestCase
{
    private InstitutionService $institutionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->institutionService = $this->app->make(InstitutionService::class);
    }


    public function testInstitutionUser()
    {
        $this->seed(DatabaseSeeder::class);
        $institution = $this->institutionService->findByName('DKPP JABAR');
        self::assertEquals(14, $institution->users->count());
    }

}
