<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Services\RecommendationService;
use App\Models\Recommendation;

class RecommendationControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/recommendations';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(RecommendationService::class);
    }

    public function testCreateSuccess()
    {
        $name = 'RECOMMENDATION_NAME_TEST';
        $payload = [
            'name' => $name,
            'description' => 'RECOMMENDATION_DESCRIPTION_TEST'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Recommendation::class, ['name' => $name]);
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

        $model = Recommendation::query()->first();
        $payload = [
            'id' => $model->id,
            'name' => $model->name . 'UPDATE_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Recommendation::class, ['name' => $model->name . 'UPDATE_NAME']);

        $payload = [
            'id' => $model->id,
            'description' => $model->description . 'UPDATE_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Recommendation::class, ['description' => $model->description . 'UPDATE_NAME']);
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

        $current_rank = Recommendation::query()->first();

        $payload = [
            'id' => $current_rank->id,
            'name' => "Kurang Baik"
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

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->post(self::BASE_ENDPOINT . '/search');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->where('message', __('messages.success.retrieve'))
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->etc()
        );
    }

    public function testDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Recommendation::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(Recommendation::class, 3);
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

        $id = Recommendation::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
