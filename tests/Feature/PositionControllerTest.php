<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Services\PositionService;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Position;
use Database\Seeders\PositionSeeder;

class PositionControllerTest extends TestCase
{
    private PositionService $positionService;

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from positions');

        $this->positionService = $this->app->make(PositionService::class);
    }

    public function testCreateSuccess()
    {
        $position_name = 'POSITION_NAME_TEST';
        $payload = [
            'name' => $position_name,
            'description' => 'POSITION_DESCRIPTION_TEST'
        ];

        $response = $this->post('/positions', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(Position::class, ['name' => $position_name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(PositionSeeder::class);

        $payload = [
            'name' => 'pengawas perikanan ahli muda',
            'description' => 'Pengawas Perikanan Ahli Muda'
        ];

        $response = $this->post('/positions', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testCreateMandatoryError()
    {
        $payload = [];

        $response = $this->post('/positions', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }
}
