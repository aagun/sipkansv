<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Services\InstitutionService;
use App\Models\Institution;
use Database\Seeders\InstitutionSeeder;

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
}
