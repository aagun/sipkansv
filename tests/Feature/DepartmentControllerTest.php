<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Services\DepartmentService;
use Illuminate\Http\Response;
use App\Models\Department;
use Database\Seeders\DepartmentSeeder;
use Illuminate\Testing\Fluent\AssertableJson;

class DepartmentControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/departments';
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from departments');

        $this->app->make(DepartmentService::class);
    }

    public function testCreateSuccess()
    {
        $department_name = 'DEPARTMENT_NAME_TEST';
        $payload = [
            'name' => $department_name,
            'description' => $department_name
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(Department::class, ['name' => $department_name]);
    }

    public function testCreateUniqueError()
    {
        $this->seed(DepartmentSeeder::class);

        $payload = [
            'name' => 'UPTD PSDKPWS',
            'description' => 'Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan',
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
        $this->seed(DepartmentSeeder::class);

        $filter = [
            'name' => 'psdkp',
            'description' => 'unit pelaksana'
        ];

        $response = $this->post( self::BASE_ENDPOINT . "/search", $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->count('data', 2)
            ->etc()
        );
    }

}
