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

    public function testUpdateSuccess()
    {
        $this->seed(PositionSeeder::class);

        $position_id = Position::query()->first()->id;
        $payload = [
            'id' => $position_id,
            'name' => 'UPDATE_NAME'
        ];

        $response = $this->put('/positions', $payload);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseHas(Position::class, ['name' => 'UPDATE_NAME']);
    }

    public function testUpdateNotExistError()
    {
        $this->seed(PositionSeeder::class);

        $position_id = 1;
        $payload = [
            'id' => $position_id,
            'name' => 'UPDATE_NAME'
        ];

        $response = $this->put('/positions', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The selected id is invalid.']);
    }

    public function testUpdateUniqueError()
    {
        $this->seed(PositionSeeder::class);

        $current_position = Position::query()->first();

        $payload = [
            'id' => $current_position->id,
            'name' => $current_position->name
        ];

        $response = $this->put('/positions', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testUpdateMandatoryError()
    {
        $payload = [];

        $response = $this->put('/positions', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The id field is required.']);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }
}
