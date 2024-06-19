<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RankService;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Rank;
use Database\Seeders\RankSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

class RankControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(RankService::class);
    }

    public function testCreateSuccess()
    {
        $rank_name = 'RANK_NAME_TEST';
        $payload = [
            'name' => $rank_name,
            'description' => 'RANK_DESCRIPTION_TEST'
        ];

        $response = $this->post('/ranks', $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Rank::class, ['name' => $rank_name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(RankSeeder::class);

        $payload = [
            'name' => 'pengatur',
            'description' => 'pengatur'
        ];

        $response = $this->post('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testCreateMandatoryError()
    {
        $payload = [];

        $response = $this->post('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function testUpdateSuccess()
    {
        $this->seed(RankSeeder::class);

        $rank_id = Rank::query()->first()->id;
        $payload = [
            'id' => $rank_id,
            'name' => 'UPDATED_NAME'
        ];

        $response = $this->put('/ranks', $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Rank::class, ['name' => 'UPDATED_NAME']);
    }

    public function testUpdateNotExistError()
    {
        $this->seed(RankSeeder::class);

        $rank_id = 1000;
        $payload = [
            'id' => $rank_id,
            'name' => 'UPDATE_NAME'
        ];

        $response = $this->put('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The selected id is invalid.']);
    }

    public function testUpdateUniqueError()
    {
        $this->seed(RankSeeder::class);

        $current_rank = Rank::query()->first();

        $payload = [
            'id' => $current_rank->id,
            'name' => $current_rank->name
        ];

        $response = $this->put('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name' => 'The name has already been taken.']);
    }

    public function testUpdateMandatoryError()
    {
        $payload = [];

        $response = $this->put('/ranks', $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['id' => 'The id field is required.']);
        $response->assertInvalid(['name' => 'The name field is required.']);
    }

    public function testSearch()
    {
        $this->seed(RankSeeder::class);

        $response = $this->post('/ranks/search', [
            'name' => 'penata',
            'description' => 'muda'
        ]);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('message', __('messages.success.retrieve'))
            ->count('data', 2)
            ->etc()
        );
    }

    public function testDeleteSuccess()
    {
        $this->seed(RankSeeder::class);

        $rank_id = Rank::query()->first()->id;

        $response = $this->delete("/ranks/$rank_id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(Rank::class, 4);
    }

    public function testDeleteFailed()
    {
        $this->seed(RankSeeder::class);

        $rank_id = 10;

        $response = $this->delete("/ranks/$rank_id");

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => "The selected $rank_id is invalid."]);
    }
}
