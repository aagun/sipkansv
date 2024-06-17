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

class UserSeeder extends Seeder
{
    private RoleService $roleService;
    private PositionService $positionService;

    private RankService $rankService;

    public function __construct(
        PositionService $positionService,
        RoleService $roleService,
        RankService $rankService
    )
    {
        $this->positionService = $positionService;
        $this->roleService = $roleService;
        $this->rankService = $rankService;
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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Muda'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Penata Tk.I'])->first()->id,
            ],
            [
                'name' => 'Suharni,S.St.Pi',
                'email' => '',
                'username' => '197312101994032005',
                'nip' => '197312101994032005',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Muda'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Penata Tk.I'])->first()->id,
            ],
            [
                'name' => 'Andri Afiandri, SH',
                'email' => '',
                'username' => '197008022007011014',
                'nip' => '197008022007011014',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengawas Perikanan Ahli Pertama'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Penata Muda Tk.I'])->first()->id,
            ],
            [
                'name' => 'Agung Wigomi, A.Md. Tra',
                'email' => '',
                'username' => '199210252020121016',
                'nip' => '199210252020121016',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengolah Data'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Pengatur'])->first()->id,
            ],
            [
                'name' => 'Yadi Supriadi',
                'email' => '',
                'username' => '197007052009011001',
                'nip' => '197007052009011001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_SUPERVISOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Petugas Pengambil Contoh'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Penata Muda'])->first()->id,
            ],


            [
                'name' => 'Tatang Hidayat, S.P.,M.P',
                'email' => '',
                'username' => '197608252007011006',
                'nip' => '197608252007011006',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_HEAD'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Kepala UPTD Pengawasan Sumber Daya Kelautan dan Perikanan Wilayah Selatan'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Pembina'])->first()->id,
            ],
            [
                'name' => 'Jajang',
                'email' => '',
                'username' => 'pimpinan1',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '',
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_HEAD'])->first()->id,
                'position_id' => null,
                'rank_id' => null,
            ],
            [
                'name' => 'Anwar',
                'email' => '',
                'username' => 'pimpinan2',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '',
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_HEAD'])->first()->id,
                'position_id' => null,
                'rank_id' => null,
            ],



            [
                'name' => 'Rizal Suripto, A.Md',
                'email' => '',
                'username' => '199212142022031003',
                'nip' => '199212142022031003',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengolah Data'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Pengatur'])->first()->id,
            ],
            [
                'name' => 'Budi Yulianto, A.Md',
                'email' => '',
                'username' => '199407132022031012',
                'nip' => '199407132022031012',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengolah Data'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Pengatur'])->first()->id,
            ],
            [
                'name' => 'Asep Sopyan Yahya, A.Md',
                'email' => '',
                'username' => '198907212022031003',
                'nip' => '198907212022031003',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Pengolah Data'])->first()->id,
                'rank_id' => $this->rankService->search(['name' => 'Pengatur'])->first()->id,
            ],
            [
                'name' => 'Siti Marwah Waraswati, S.Kel',
                'email' => '',
                'username' => '3578254609920001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'nip' => '3578254609920001',
                'gender' => Gender::FEMALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Tenaga Teknis'])->first()->id,
                'rank_id' => null,
            ],
            [
                'name' => 'Yuni Kartika, S.T',
                'email' => '',
                'username' => '3203014806960001',
                'nip' => '3203014806960001',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::FEMALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Tenaga Teknis'])->first()->id,
                'rank_id' => null,
            ],
            [
                'name' => 'Genta Fabiyanto, S. St. Pi',
                'email' => '',
                'username' => '3201290603840004',
                'nip' => '3201290603840004',
                'password' => Hash::make('@AaBbCcDd1234'),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'gender' => Gender::MALE,
                'status' => UserStatus::ACTIVE,
                'role_id' => $this->roleService->searchRole(['name' => 'RO_OPERATOR'])->first()->id,
                'position_id' => $this->positionService->search(['name' => 'Tenaga Teknis'])->first()->id,
                'rank_id' => null,
            ],
        ];

        User::query()->insert($users);

    }
}
