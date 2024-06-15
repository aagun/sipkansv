<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\Impl\PositionServiceImpl;
use App\Services\PositionService;
use Illuminate\Support\Facades\DB;
use App\Models\Position;

class PositionServiceTest extends TestCase
{
    private PositionService $positionService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from positions');

        $this->positionService = $this->app->make(PositionService::class);
    }

    public function testPositionSave()
    {
        $position_name = 'POSITION_TEST';
        $position = [
            'name' => $position_name,
            'description' => 'Position description test'
        ];

        $this->positionService->save($position);

        $this->assertDatabaseHas(Position::class, ['name' => $position_name]);
    }

    public function testPositionSaveAll()
    {
        $positions = [
            [
                'name' => 'POSITION_TEST_1',
                'description' => 'Position description test-1'
            ],
            [
                'name' => 'POSITION_TEST_2',
                'description' => 'Position description test-2'
            ]
        ];

        $this->positionService->saveAll($positions);

        $this->assertDatabaseCount(Position::class, 2);
    }


}
