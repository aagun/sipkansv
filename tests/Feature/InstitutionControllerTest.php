<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Services\InstitutionService;
use App\Models\Institution;
use Database\Seeders\InstitutionSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use Database\Seeders\DatabaseSeeder;

class InstitutionControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/institutions';
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from institutions');

        $this->app->make(InstitutionService::class);
    }

    public function testCreateSuccess()
    {
        $name = 'INSTITUTION_NAME_TEST';
        $payload = [
            'name' => $name,
            'description' => $name
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => 'Record created successfully.']);
        $this->assertDatabaseHas(Institution::class, ['name' => $name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(InstitutionSeeder::class);

        $payload = [
            'name' => 'Dinas Kelautan dan Perikanan Provinsi Jawa Barat',
            'description' => 'Dinas Kelautan dan Perikanan Provinsi Jawa Barat',
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
        $this->seed(InstitutionSeeder::class);

        $filter = ['search' => ['description' => 'jawa barat']];

        $response = $this->post( self::BASE_ENDPOINT . "/search", $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->etc()
        );
    }

    public function testUpdateSuccess()
    {
        $this->seed(InstitutionSeeder::class);

        $id = Institution::query()->first()->id;
        $payload = [
            'id' => $id,
            'name' => 'UPDATED_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Institution::class, ['name' => 'UPDATED_NAME']);
    }

    public function testUpdateNotExistError()
    {
        $this->seed(InstitutionSeeder::class);

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
        $this->seed(InstitutionSeeder::class);

        $current_data = Institution::query()->first();

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
        $this->seed(InstitutionSeeder::class);

        $id = Institution::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . '/' . $id);
        $response->assertStatus(Response::HTTP_OK);
        $this->assertDatabaseCount(Institution::class, 0);
    }

    public function testDeleteFailed()
    {
        $this->seed(InstitutionSeeder::class);

        $id = 10;

        $response = $this->delete(self::BASE_ENDPOINT .  '/' . $id);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => "The selected id is invalid."]);
    }

    public function testInstitutionDetail()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testInstitutionDetailSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Institution::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
