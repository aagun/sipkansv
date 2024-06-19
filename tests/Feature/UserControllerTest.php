<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Support\Str;
use App\Services\RoleService;
use App\Services\PositionService;
use App\Services\RankService;
use App\Services\DepartmentService;
use App\Services\InstitutionService;
use App\Services\GradeLevelService;
use App\Services\EducationService;
use Illuminate\Http\Response;
use Database\Seeders\DatabaseSeeder;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

class UserControllerTest extends TestCase
{
    private const BASE_ENDPOINT = '/users';
    private RoleService $roleService;
    private PositionService $positionService;
    private RankService $rankService;
    private DepartmentService $departmentService;
    private InstitutionService $institutionService;
    private GradeLevelService $gradeLevelService;
    private EducationService $educationService;


    protected function setUp(): void
    {
        parent::setUp();

        $this->roleService = $this->app->make(RoleService::class);
        $this->positionService = $this->app->make(PositionService::class);
        $this->rankService = $this->app->make(RankService::class);
        $this->departmentService = $this->app->make(DepartmentService::class);
        $this->institutionService = $this->app->make(InstitutionService::class);
        $this->gradeLevelService = $this->app->make(GradeLevelService::class);
        $this->educationService = $this->app->make(EducationService::class);
        $this->userService = $this->app->make(UserService::class);
    }

    public function testCreateFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = [
            'name' => 'Ari Wibowo, S.T., M.AP',
            'email' => 'eri@',
            'username' => '198109022009021001',
            'nip' => '198109022009021001',
            'password' => '@aabbccdd1234',
            'remember_token' => Str::random(10),
            'phone' => '08122066949',
            'gender' => 'l',
            'status' => 'active',
            'role' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id + 1000,
            'position' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Muda'])->first()->id + 10000,
            'rank' => $this->rankService->search(['name' => 'Penata Tk.I'])->first()->id + 10000,
            'department' => $this->departmentService->search(['name' => 'UPTD PSDKPWS'])->first()->id + 100000,
            'institution' => $this->institutionService->search(['name' => 'DKPP JABAR'])->first()->id + 100000,
            'grade_level'=> $this->gradeLevelService->search(['name' => 'III/D'])->first()->id + 100000,
            'education' => $this->educationService->search(['name' => 'S2'])->first()->id + 100000,
        ];

        $response = $this->post(self::BASE_ENDPOINT, $user);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid([
            'password' => "The password field must contain at least one uppercase and one lowercase letter.",
            'role' => "The selected role is invalid.",
            'position' => "The selected position is invalid.",
            'education' => "The selected education is invalid.",
            'rank' => "The selected rank is invalid.",
            'grade_level' => "The selected grade level is invalid.",
            'department' => "The selected department is invalid.",
            'institution' => "The selected institution is invalid.",
        ]);
    }

    public function testCreateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = [
            'name' => 'User Test Success',
            'email' => 'eri@example.com',
            'username' => 'user_test',
            'nip' => '198109022009021001',
            'password' => '@aAdi1d1234',
            'remember_token' => Str::random(10),
            'phone' => '08122066949',
            'gender' => 'l',
            'status' => 'aktif',
            'role' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
            'position' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Muda'])->first()->id,
            'rank' => $this->rankService->search(['name' => 'Penata Tk.I'])->first()->id,
            'department' => $this->departmentService->search(['name' => 'UPTD PSDKPWS'])->first()->id,
            'institution' => $this->institutionService->search(['name' => 'DKPP JABAR'])->first()->id,
            'grade_level'=> $this->gradeLevelService->search(['name' => 'III/D'])->first()->id,
            'education' => null,
        ];

        $response = $this->post(self::BASE_ENDPOINT, $user);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas(User::class, ['name' => 'User Test Success']);
    }

    public function testUpdateFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = [
            'name' => 'Ari Wibowo, S.T., M.AP',
            'email' => 'eri@',
            'username' => '198109022009021001',
            'nip' => '198109022009021001',
            'password' => '@aabbccdd1234',
            'remember_token' => Str::random(10),
            'phone' => '08122066949',
            'gender' => 'l',
            'status' => 'active',
            'role' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id + 1000,
            'position' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Muda'])->first()->id + 10000,
            'rank' => $this->rankService->search(['name' => 'Penata Tk.I'])->first()->id + 10000,
            'department' => $this->departmentService->search(['name' => 'UPTD PSDKPWS'])->first()->id + 100000,
            'institution' => $this->institutionService->search(['name' => 'DKPP JABAR'])->first()->id + 100000,
            'grade_level'=> $this->gradeLevelService->search(['name' => 'III/D'])->first()->id + 100000,
            'education' => $this->educationService->search(['name' => 'S2'])->first()->id + 100000,
        ];

        $response = $this->post(self::BASE_ENDPOINT, $user);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $response->assertInvalid([
            'password' => "The password field must contain at least one uppercase and one lowercase letter.",
            'role' => "The selected role is invalid.",
            'position' => "The selected position is invalid.",
            'education' => "The selected education is invalid.",
            'rank' => "The selected rank is invalid.",
            'grade_level' => "The selected grade level is invalid.",
            'department' => "The selected department is invalid.",
            'institution' => "The selected institution is invalid.",
        ]);
    }

    public function testUpdateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = User::query()->first()->id;

        $user = [
            'id' => $id,
            'name' => 'User Test Success',
        ];

        $response = $this->put(self::BASE_ENDPOINT, $user);
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonFragment(['message' => __('messages.success.updated')]);
        $this->assertDatabaseHas(User::class, ['name' => 'User Test Success']);
    }

    public function testDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $id = User::query()->first()->id;
        $response = $this->delete(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.deleted')]);
        $this->assertDatabaseHas('users', ['id' => $id, 'status' => 'non-aktif']);
    }

    public function testDeleteFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $id = 90;
        $response = $this->delete(self::BASE_ENDPOINT . "/$id");
        $response->assertStatus(Response::HTTP_NOT_FOUND);
        $response->assertInvalid(['id' => 'The selected id is invalid.']);
    }

    public function testSearch()
    {
        $this->seed(DatabaseSeeder::class);

        $filter = [];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
        $response->assertJson(fn (AssertableJson $json) => $json->count('data', 14)->etc());
    }

    public function testSearchWithFilter()
    {
        $this->seed(DatabaseSeeder::class);

        $filter = [
            'name' => '1'
        ];
        $response = $this->post(self::BASE_ENDPOINT . '/search', $filter);

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
        $response->assertJson(fn (AssertableJson $json) => $json->count('data', 12)->etc());
    }

    public function testDetail()
    {
        $this->seed(DatabaseSeeder::class);

        $id = User::query()->first()->id;
        $response = $this->get(self::BASE_ENDPOINT . "/$id");

        var_dump($response->content());

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment(['message' => __('messages.success.retrieve')]);
    }
}
