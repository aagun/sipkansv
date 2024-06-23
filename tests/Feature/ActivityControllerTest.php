<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Services\ActivityService;
use App\Models\Activity;

class ActivityControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/activities';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(ActivityService::class);
    }

    public function testCreateSuccess()
    {
        $name = 'Activity_NAME_TEST';
        $payload = [
            'name' => $name,
            'description' => 'Activity_DESCRIPTION_TEST'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Activity::class, ['name' => $name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(DatabaseSeeder::class);

        $payload = [
            'name' => 'Kurang Baik',
            'description' => 'Perbaikan'
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

    public function testUpdateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Activity::query()->first()->id;
        $payload = [
            'id' => $id,
            'name' => 'UPDATED_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Activity::class, ['name' => 'UPDATED_NAME']);
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

        $current_rank = Activity::query()->first();

        $payload = [
            'id' => $current_rank->id,
            'name' => $current_rank->name
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

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->post(self::BASE_ENDPOINT . '/search');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', __('messages.success.retrieve'))
            ->count('data', 4)
            ->etc()
        );
    }

    public function testDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Activity::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(Activity::class, 3);
    }

    public function testDeleteFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $rank_id = 10;

        $response = $this->delete(self::BASE_ENDPOINT . "/$rank_id");

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

        $id = Activity::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
