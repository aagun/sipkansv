<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RankService;
use Database\Seeders\DatabaseSeeder;

class RankServiceTest extends TestCase
{
    private RankService $rankService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rankService = $this->app->make(RankService::class);
    }

    public function testRankUsers()
    {
        $this->seed(DatabaseSeeder::class);
        $rank = $this->rankService->findByName('Pengatur');
        self::assertEquals(4, $rank->users->count());
    }


}
