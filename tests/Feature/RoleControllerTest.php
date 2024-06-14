<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Services\RoleService;
use Illuminate\Http\Response;
use App\Models\Role;
use Illuminate\Testing\Fluent\AssertableJson;

class RoleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete('delete from roles');
        $this->app->make(RoleService::class);
    }

    public function testCreateRole()
    {
        $role_name = 'RO_TEST_ADMIN';
        $payload = [
          'name' => $role_name,
          'description' => 'Test admin role'
        ];

        $response = $this->post('roles', $payload);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(Role::class, ['name' => $role_name]);
    }

    public function testCreateRoleFailedMandatory()
    {
        $role_name = 'RO_TEST_ADMIN';
        $payload = [];

        $response = $this->post('roles', $payload);

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

        $response = $this->post('roles', $payload);

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

        $response = $this->post('roles', $payload);

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

        $response = $this->post('roles', $payload);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->hasAll(['status', 'message', 'data', 'errors'])
            ->where('errors', null)
            ->etc()
        );
        $response->assertValid(['name', 'description']);
    }
}
