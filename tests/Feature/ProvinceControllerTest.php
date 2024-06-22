<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Province;
use App\Services\ProvinceService;

class ProvinceControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/provinces';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(ProvinceService::class);
    }

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);
        $filter = [
            'search' => ['name' => 'jawa']
        ];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->where('message', __('messages.success.retrieve'))
            ->where('total', 3)
            ->count('data', 3)
            ->etc()
        );
    }

    public function testDetail()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testDetailSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Province::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
