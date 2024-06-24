<?php

namespace Tests\Feature;

use Tests\TestCase;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\DistrictSeeder;
use Database\Seeders\SubDistrictSeeder;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Services\VillageService;
use Database\Seeders\VillageSeeder;
use App\Models\Village;

class VillageControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/villages';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(VillageService::class);
    }

    public function testSearch()
    {
        $this->seed([
            ProvinceSeeder::class,
            DistrictSeeder::class,
            SubDistrictSeeder::class,
            VillageSeeder::class]
        );

        $filter = [
            'search' => ['sub_district_id' => 110101]
        ];

        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->where('message', __('messages.success.retrieve'))
            ->where('total', 7)
            ->count('data', 7)
            ->etc()
        );
    }

    public function testDetail()
    {
        $this->seed([
                ProvinceSeeder::class,
                DistrictSeeder::class,
                SubDistrictSeeder::class,
                VillageSeeder::class]
        );

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testDetailSuccess()
    {
        $this->seed([
                ProvinceSeeder::class,
                DistrictSeeder::class,
                SubDistrictSeeder::class,
                VillageSeeder::class]
        );

        $id = Village::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
