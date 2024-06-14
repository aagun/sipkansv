<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Services\RoleService;
use Illuminate\Http\Response;
use App\Models\Role;

class RoleControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
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

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
