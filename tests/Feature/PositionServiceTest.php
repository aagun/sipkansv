<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\PositionService;
use App\Models\Position;
use Database\Seeders\DatabaseSeeder;

class PositionServiceTest extends TestCase
{
    private PositionService $positionService;

    protected function setUp(): void
    {
        parent::setUp();

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

    public function testPositionsUpdate()
    {
        $this->seed(DatabaseSeeder::class);

        $position_id = Position::query()->first()->id;
        $position = [
            'id' => $position_id,
            'name' => 'updated'
        ];

        $is_success = $this->positionService->update($position);

        self::assertTrue($is_success);
        $this->assertDatabaseHas(Position::class, ['name' => 'updated']);
    }

    public function testPositionDelete()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Position::query()->first()->id;

        $this->positionService->delete($id);

        $this->assertDatabaseCount(Position::class, 5);
    }

    public function testPositionUsers()
    {
        $this->seed(DatabaseSeeder::class);

        $name = 'Pengolah Data';
        $position = $this->positionService->findByName($name);
        self::assertEquals(4, $position->users->count() );
    }
}
