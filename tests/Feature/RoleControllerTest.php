<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RoleService;
use Illuminate\Http\Response;
use App\Models\Role;
use Illuminate\Testing\Fluent\AssertableJson;
use Database\Seeders\RoleSeeder;
use Database\Seeders\DatabaseSeeder;

class RoleControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/roles';
    private RoleService $roleService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->roleService = $this->app->make(RoleService::class);
    }

    public function testCreateRole()
    {
        $role_name = 'RO_TEST_ADMIN';
        $payload = [
          'name' => $role_name,
          'description' => 'Test admin role'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.created')]);
        $this->assertDatabaseHas(Role::class, ['name' => $role_name]);
    }

    public function testCreateRoleFailedMandatory()
    {
        $role_name = 'RO_TEST_ADMIN';
        $payload = [];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->whereNot('errors', null)
            ->etc()
        );
        $response->assertInvalid([
            'name' => 'The name field is required',
            'description' => 'The description field is required'
        ]);
    }

    public function testCreateRoleFailedNotUnique()
    {
        $this->testCreateRole();

        $role_name = 'RO_TEST_ADMIN';
        $payload = [
            'name' => $role_name,
            'description' => 'Test admin role'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->whereNot('errors', null)
            ->etc()
        );
        $response->assertInvalid([
            'name' => 'The name has already been taken.'
        ]);
    }

    public function testCreateRoleInvalidPrefixName()
    {
        $role_name = 'TEST_ADMIN';
        $payload = [
            'name' => $role_name,
            'description' => 'Test admin role'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->whereNot('errors', null)
            ->etc()
        );
        $response->assertInvalid([
            'name' => 'The name field must start with one of the following: RO_.',
        ]);
    }

    public function testCreateRoleValidPrefixName()
    {
        $role_name = 'ro_TEST_ADMINS';
        $payload = [
            'name' => $role_name,
            'description' => 'Test admin role'
        ];

        $response = $this->post(self::BASE_ENDPOINT, $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->where('errors', null)
            ->etc()
        );
        $response->assertValid(['name', 'description']);
    }

    public function testSearchRoleSuccess()
    {
        $this->seed(RoleSeeder::class);

        $payload = [];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $payload);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'message', 'data', 'errors', 'total'])
            ->where('errors', null)
            ->count('data', 4)
        );
    }

    public function testSearchRoleFilteredByName()
    {
        $this->seed(RoleSeeder::class);

        $payload = [
            'search' => ['name' => 'adm']
        ];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $payload);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json->hasAll(['status', 'message', 'data', 'errors', 'total'])
            ->where('errors', null)
            ->count('data', 1)
        );
    }

    public function testEditRoleSuccess()
    {
        $this->seed(RoleSeeder::class);

        $id = Role::query()->select(['id'])->whereRaw("name LIKE CONCAT('%', 'adm', '%')")->first()->id;
        $response = $this->put(self::BASE_ENDPOINT . "/$id", ['name' => 'RO_ADMIN_UPDATED']);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(Role::class, ['name' => 'RO_ADMIN_UPDATED']);
    }

    public function testEditRoleNotFound()
    {
        $this->seed(RoleSeeder::class);

        $id = 1;
        $response = $this->put(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => ["The selected id is invalid."]]);
    }

    public function testEditRoleFailed()
    {
        $this->seed(RoleSeeder::class);

        $role_id = $this->roleService->findOneByName('RO_ADMIN')->id;
        $response = $this->put(self::BASE_ENDPOINT . "/$role_id", ['name' => ' ', 'description' => ' ']);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid(['name', 'description']);
    }

    public function testDeleteRoleSuccess()
    {
        $this->seed(RoleSeeder::class);

        $role_id = $this->roleService->findOneByName('RO_ADMIN')->id;
        $response = $this->delete(self::BASE_ENDPOINT . "/$role_id");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseMissing(Role::class, ['id' => $role_id]);
    }

    public function testDeleteRoleNotFound()
    {
        $this->seed(RoleSeeder::class);

        $id = 1;
        $response = $this->delete(self::BASE_ENDPOINT . "/$id");

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

        $id = Role::query()->first()->id;

        $response = $this->get(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->whereNot('data', null)
            ->etc()
        );
    }
}
