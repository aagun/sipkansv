<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Services\DistrictService;
use App\Models\District;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\DistrictSeeder;

class DistrictControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/districts';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(DistrictService::class);
    }

    public function testSearch()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class]);
        $filter = [
            'search' => ['province_id' => 11]
        ];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->where('message', __('messages.success.retrieve'))
            ->where('total', 19)
            ->count('data', 10)
            ->etc()
        );
    }

    public function testDetail()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class]);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testDetailSuccess()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class]);

        $id = District::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
