<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\GradeLevel;
use App\Services\GradeLevelService;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

class GradeLevelControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/grade-levels';
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(GradeLevelService::class);
    }

    public function testCreateSuccess()
    {
        $name = 'grade_level_name_test';
        $description = 'grade_level_name_test';

        $payload = [
            'name' => $name,
            'description' => $description
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(GradeLevel::class, ['name' => strtoupper($name)]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(DatabaseSeeder::class);

        $payload = [
            'name' => 'II/C',
            'description' => 'Golongan II/C',
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid([
            'name' => 'The name has already been taken.',
        ]);
    }

    public function testCreateMandatoryError()
    {
        $payload = [];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $filter = [
            'name' => 'II/',
            'description' => 'c'
        ];

        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->count('data', 2)
            ->etc()
        );
    }

    public function testUpdateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = GradeLevel::query()->first()->id;
        $name = 'UPDATED GRADE LEVEL';
        $payload = [
            'id' => $id,
            'name' => $name,
            'description' => $name
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(GradeLevel::class, ['name' => $name]);
    }

    public function testUpdateNotExistError()
    {
        $this->seed(DatabaseSeeder::class);

        $id = 1000;
        $payload = [
            'id' => $id,
            'name' => 'UPDATE_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The selected id is invalid.']);
    }

    public function testUpdateUniqueError()
    {
        $this->seed(DatabaseSeeder::class);

        $current_data = GradeLevel::query()->first();

        $payload = [
            'id' => $current_data->id,
            'name' => $current_data->name
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testUpdateMandatoryError()
    {
        $payload = [];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The id field is required.']);
    }

    public function testDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = GradeLevel::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . '/' . $id);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(GradeLevel::class, 12);
    }

    public function testDeleteFailed()
    {
        $id = 10;
        $response = $this->delete(self::BASE_ENDPOINT .  '/' . $id);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => "The selected id is invalid."]);
    }
}
