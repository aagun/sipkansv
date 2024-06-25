<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use App\Models\SubSector;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Services\KbliService;
use App\Models\Kbli;

class KbliControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/kblis';

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(KbliService::class);
    }

    public function testCreateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $name = 'KBLI_NAME_TEST';
        $payload = [
            'code' => 12345,
            'name' => $name,
            'sub_sector_id' => SubSector::query()->where('name', 'Pemasaran Hasil Perikanan')->first()->id
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Kbli::class, ['name' => $name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(DatabaseSeeder::class);

        $payload = [
            'code' => 03111,
            'name' => 'Penangkapan Pisces/Ikan Bersirip di Laut',
            'sub_sector_id' => -99
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

        $id = Kbli::query()->first()->id;
        $payload = [
            'id' => $id,
            'name' => 'UPDATED_NAME'
        ];

        $response = $this->put(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Kbli::class, ['name' => 'UPDATED_NAME']);
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

        $current_rank = Kbli::query()->first();

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
    }

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $filter = ['sort' => 'name'];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

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

        $id = Kbli::query()->first()->id;

        $response = $this->delete(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseCount(Kbli::class, 111);
    }

    public function testDeleteFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $rank_id = 10;

        $response = $this->delete(self::BASE_ENDPOINT . "/$rank_id");

        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => "The selected id is invalid."]);
    }

    public function testKbliDetail()
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->get(self::BASE_ENDPOINT);
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->where('data', null)
            ->etc()
        );
    }

    public function testKbliDetailSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = Kbli::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }

    public function testKbliSubSector()
    {
        $this->seed(DatabaseSeeder::class);
        $kbli = Kbli::query()->first();
        self::assertNotNull($kbli->subSector);

    }

}
