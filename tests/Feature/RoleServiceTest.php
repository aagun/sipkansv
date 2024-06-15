<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RoleService;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleServiceTest extends TestCase
{
    // use RefreshDatabase;

    private RoleService $roleService;
    private const TEST_ADMIN = 'RO_TEST_ADMIN';

    protected function setUp(): void
    {
        parent::setUp();

        DB::delete('delete from roles');
        $this->roleService = $this->app->make(RoleService::class);
    }

    public function testSaveRole()
    {
        $role = [
            'name' => self::TEST_ADMIN,
            'description' => 'Test Role Admin'
        ];

        $this->roleService->save($role);

        $this->assertDatabaseHas('roles', ['name' => self::TEST_ADMIN]);
    }

    public function testSaveAllRoles()
    {
        $this->testSaveRole();

        $roles = [
            [
                'name' => 'RO_TEST_PENGAWAS',
                'description' => 'Test Role Pengawas'
            ],
            [
                'name' => 'RO_TEST_PIMPINAN',
                'description' => 'Test Role Pimpinan'
            ],
            [
                'name' => 'RO_TEST_OPERATOR',
                'description' => 'Test Role Operator'
            ]
        ];

        $this->roleService->saveAll($roles);

        $this->assertDatabaseCount('roles', 4);
    }

    public function testFindOne()
    {
        $this->testSaveAllRoles();

        $role_id = $this->roleService->findOneByName(self::TEST_ADMIN)['id'];
        $role = $this->roleService->findOne($role_id);
        self::assertNotNull($role);
    }

    public function testFindAll()
    {
        $this->testSaveAllRoles();

        $roles = $this->roleService->findAll();
        self::assertEquals(4, $roles->count());
    }

    public function testUpdate()
    {
        $this->testSaveAllRoles();

        $role_id = $this->roleService->findOneByName('RO_TEST_PENGAWAS')['id'];
        $role = [
            'id' => $role_id,
            'name' => 'RO_ADMIN',
            'description' => 'Admin'
        ];

        $is_success = $this->roleService->update($role);

        self::assertTrue($is_success);
        $this->assertDatabaseHas(Role::class, ['name' => self::TEST_ADMIN]);
    }

    public function testRoleUsers()
    {
        $this->testSaveAllRoles();

        $role_id = $this->roleService->findOneByName(self::TEST_ADMIN)['id'];
        $role = $this->roleService->findOne($role_id);
        $users = $role->users();
        self::assertEquals(0, $users->count());
    }

    public function testDelete()
    {
        $this->testSaveAllRoles();

        $role_id = $this->roleService->findOneByName(self::TEST_ADMIN)['id'];
        $is_deleted = $this->roleService->delete($role_id);

        self::assertTrue($is_deleted);
        $this->assertDatabaseCount('roles', 3);
    }
}
