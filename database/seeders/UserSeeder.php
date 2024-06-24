<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\PositionService;
use App\Services\RoleService;
use App\Enums\UserStatus;
use App\Enums\Gender;
use App\Models\User;
use App\Services\RankService;
use App\Services\DepartmentService;
use App\Services\InstitutionService;
use App\Services\GradeLevelService;
use App\Services\EducationService;

class UserSeeder extends Seeder
{
    private RoleService $roleService;
    private PositionService $positionService;
    private RankService $rankService;
    private DepartmentService $departmentService;
    private InstitutionService $institutionService;
    private GradeLevelService $gradeLevelService;
    private EducationService $educationService;

    public function __construct(
        PositionService $positionService,
        RoleService $roleService,
        RankService $rankService,
        DepartmentService $departmentService,
        InstitutionService $institutionService,
        GradeLevelService $gradeLevelService,
        EducationService $educationService
    )
    {
        $this->positionService = $positionService;
        $this->roleService = $roleService;
        $this->rankService = $rankService;
        $this->departmentService = $departmentService;
        $this->institutionService = $institutionService;
        $this->gradeLevelService = $gradeLevelService;
        $this->educationService = $educationService;
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ari Wibowo, S.T., M.AP',
                'email' => '',
                'username' => '198109022009021001',
                'nip' => '198109022009021001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '08122066949',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_SUPERVISOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengawas Perikanan Ahli Muda')->id,
                'rank_id' => $this->rankService->findByName('Penata Tk.I')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('III/D')->id,
                'education_id' => $this->educationService->findByName('S2')->id,
            ],
            [
                'name' => 'Suharni,S.St.Pi',
                'email' => '',
                'username' => '197312101994032005',
                'nip' => '197312101994032005',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081228630106',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_SUPERVISOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengawas Perikanan Ahli Muda')->id,
                'rank_id' => $this->rankService->findByName('Penata Tk.I')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('III/D')->id,
                'education_id' => $this->educationService->findByName('D4')->id,
            ],
            [
                'name' => 'Andri Afiandri, SH',
                'email' => '',
                'username' => '197008022007011014',
                'nip' => '197008022007011014',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081931469652',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_SUPERVISOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengawas Perikanan Ahli Pertama')->id,
                'rank_id' => $this->rankService->findByName('Penata Muda Tk.I')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('III/B')->id,
                'education_id' => $this->educationService->findByName('S1')->id,
            ],
            [
                'name' => 'Agung Wigomi, A.Md. Tra',
                'email' => '',
                'username' => '199210252020121016',
                'nip' => '199210252020121016',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '082233068882',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_SUPERVISOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengolah Data')->id,
                'rank_id' => $this->rankService->findByName('Pengatur')->id,
                'department_id' => $this->departmentService->findByName('Bidang Pengawasan Sumber Daya Kelautan dan Perikanan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('II/C')->id,
                'education_id' => $this->educationService->findByName('D3')->id,
            ],
            [
                'name' => 'Yadi Supriadi',
                'email' => '',
                'username' => '197007052009011001',
                'nip' => '197007052009011001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '085353211775',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_SUPERVISOR')->first()->id,
                'position_id' => $this->positionService->findByName( 'Petugas Pengambil Contoh')->id,
                'rank_id' => $this->rankService->findByName('Penata Muda')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('III/A')->id,
                'education_id' => $this->educationService->findByName('SMA')->id,
            ],


            [
                'name' => 'Tatang Hidayat, S.P.,M.P',
                'email' => '',
                'username' => '197608252007011006',
                'nip' => '197608252007011006',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081394039506',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_HEAD')->id,
                'position_id' => $this->positionService->findByName( 'Kepala UPTD Pengawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'rank_id' => $this->rankService->findByName('Pembina')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('IV/A')->id,
                'education_id' => $this->educationService->findByName('S2')->id,
            ],
            [
                'name' => 'Jajang',
                'email' => '',
                'username' => 'pimpinan1',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '',
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_HEAD')->id,
                'position_id' => null,
                'rank_id' => null,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id' => null,
                'education_id' => null,
            ],
            [
                'name' => 'Anwar',
                'email' => '',
                'username' => 'pimpinan2',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '',
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_HEAD')->id,
                'position_id' => null,
                'rank_id' => null,
                'department_id' => $this->departmentService->findByName('Bidang Pengawasan Sumber Daya Kelautan dan Perikanan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id' => null,
                'education_id' => null,
            ],



            [
                'name' => 'Rizal Suripto, A.Md',
                'email' => '',
                'username' => '199212142022031003',
                'nip' => '199212142022031003',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '082215646634',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengolah Data')->id,
                'rank_id' => $this->rankService->findByName('Pengatur')->id,
                'department_id' => $this->departmentService->findByName('Bidang Pengawasan Sumber Daya Kelautan dan Perikanan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('II/C')->id,
                'education_id' => $this->educationService->findByName('D3')->id,
            ],
            [
                'name' => 'Budi Yulianto, A.Md',
                'email' => '',
                'username' => '199407132022031012',
                'nip' => '199407132022031012',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081291863550',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengolah Data')->id,
                'rank_id' => $this->rankService->findByName('Pengatur')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('II/C')->id,
                'education_id' => $this->educationService->findByName('D4')->id,
            ],
            [
                'name' => 'Asep Sopyan Yahya, A.Md',
                'email' => '',
                'username' => '198907212022031003',
                'nip' => '198907212022031003',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081222271412',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Pengolah Data')->id,
                'rank_id' => $this->rankService->findByName('Pengatur')->id,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id'=> $this->gradeLevelService->findByName('II/C')->id,
                'education_id' => $this->educationService->findByName('D5')->id,
            ],
            [
                'name' => 'Siti Marwah Waraswati, S.Kel',
                'email' => '',
                'username' => '3578254609920001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '087783223220',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '3578254609920001',
                'gender' => Gender::FEMALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Tenaga Teknis')->id,
                'rank_id' => null,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id' => null,
                'education_id' => $this->educationService->findByName('S1')->id,
            ],
            [
                'name' => 'Yuni Kartika, S.T',
                'email' => '',
                'username' => '3203014806960001',
                'nip' => '3203014806960001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081381591066',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::FEMALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Tenaga Teknis')->id,
                'rank_id' => null,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Utara')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id' => null,
                'education_id' => $this->educationService->findByName('S1')->id,
            ],
            [
                'name' => 'Genta Fabiyanto, S. St. Pi',
                'email' => '',
                'username' => '3201290603840004',
                'nip' => '3201290603840004',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'phone' => '081382979870',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->findOneByName('RO_OPERATOR')->id,
                'position_id' => $this->positionService->findByName( 'Tenaga Teknis')->id,
                'rank_id' => null,
                'department_id' => $this->departmentService->findByName('Unit Pelaksana Teknis Daerah Penggawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan')->id,
                'institution_id' => $this->institutionService->findByName('Dinas Kelautan dan Perikanan Provinsi Jawa Barat')->id,
                'grade_level_id' => null,
                'education_id' => $this->educationService->findByName('D4')->id,
            ],
        ];

        User::query()->insert($users);

    }
}
