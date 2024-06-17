<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Services\DepartmentService;
use Illuminate\Http\Response;
use App\Models\Department;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Database\Seeders\DatabaseSeeder;

class DepartmentControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/departments';
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from departments');
        DB::delete('delete from users');

        $this->app->make(DepartmentService::class);
    }

    public function testCreateSuccess()
    {
        $department_name = 'DEPARTMENT_NAME_TEST';
        $payload = [
            'name' => $department_name,
            'description' => $department_name
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Department::class, ['name' => $department_name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(DepartmentSeeder::class);

        $payload = [
            'name' => 'UPTD PSDKPWS',
            'description' => 'Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan',
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
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
            'name' => 'psdkp',
            'description' => 'unit pelaksana'
        ];

        $response = $this->post( self::BASE_ENDPOINT . "/search", $filter);

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

        $id = Department::query()->first()->id;
        $payload = [
            'id' => $id,
            'name' => 'UPDATED_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Department::class, ['name' => 'UPDATED_NAME']);
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

        $current_data = Department::query()->first();

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
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function testDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Department::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . '/' . $id);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(Department::class, 2);
    }

    public function testDeleteFailed()
    {
        $id = 10;
        $response = $this->delete(self::BASE_ENDPOINT .  '/' . $id);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => "The selected $id is invalid."]);
    }

}
