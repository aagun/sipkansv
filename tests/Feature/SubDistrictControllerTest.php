<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\SubDistrictService;
use Database\Seeders\ProvinceSeeder;
use Database\Seeders\DistrictSeeder;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\SubDistrict;
use Database\Seeders\SubDistrictSeeder;

class SubDistrictControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/sub-districts';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(SubDistrictService::class);
    }

    public function testSearch()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class, SubDistrictSeeder::class]);
        $filter = [
            'search' => ['district_id' => 1101]
        ];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);
        $response->assertStatus(Response::HTTP_OK);
        p_info($response->content());
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'data', 'message', 'errors'])
            ->where('message', __('messages.success.retrieve'))
            ->where('total', 18)
            ->count('data', 10)
            ->etc()
        );
    }

    public function testDetail()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class, SubDistrictSeeder::class]);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testDetailSuccess()
    {
        $this->seed([ProvinceSeeder::class, DistrictSeeder::class, SubDistrictSeeder::class]);

        $id = SubDistrict::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
