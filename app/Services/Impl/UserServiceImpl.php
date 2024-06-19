<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class UserServiceImpl implements UserService
{
    public function findOne(int $id): Builder | Model | null
    {
        return User::query()->where('id', $id)->first();
    }

    public function findByName(string $name): Builder | Model | null
    {
        return User::query()->where('name', $name)->first();
    }

    public function exists(int $id): bool
    {
        return User::query()->where('id', $id)->exists();
    }

    public function existsByName(string $name): bool
    {
        return User::query()->where('name', $name)->exists();
    }

    public function save(array $user): Builder | Model
    {
        return User::query()->create($user);
    }

    public function saveAll(array $users): void
    {
        foreach ($users as $user) {
            $this->save($user);
        }
    }

    public function search(array $filter): Collection
    {
        return User::query()
            ->leftJoin('roles', 'role.id' ,'=', 'users.role_id')
            ->leftJoin('positions', 'positions.id' ,'=', 'users.position_id')
            ->leftJoin('ranks', 'ranks.id' ,'=', 'users.rank_id')
            ->leftJoin('grade_levels', 'grade_levels.id' ,'=', 'users.grade_level_id')
            ->leftJoin('educations', 'educations.id' ,'=', 'users.education_id')
            ->leftJoin('departments', 'departments.id' ,'=', 'users.department_id')
            ->leftJoin('institutions', 'institutions.id' ,'=', 'users.institution_id')
            ->when($filter, function (Builder $query, array $filter) {
                if (isset($filter['status'])) {
                    $query->where('users.status', $filter['status']);
                }

                if (isset($filter['name'])) {
                    $user_name = '%' . $filter['name'] . '%';
                    $query->whereAny(['users.name', 'users.nip'], 'LIKE', $user_name);
                }

                if (isset($filter['position_id'])) {
                    $query->where('users.position_id', $filter['position_id']);
                }

                if (isset($filter['rank_id'])) {
                    $query->where('users.rank_id', $filter['rank_id']);
                }

                if (isset($filter['grade_level_id'])) {
                    $query->where('users.grade_level_id', $filter['grade_level_id']);
                }

                if (isset($filter['education_id'])) {
                    $query->where('users.education_id', $filter['education_id']);
                }

                if (isset($filter['institution_id'])) {
                    $query->where('users.institution_id', $filter['institution_id']);
                }
            })
            ->orderByRaw("users.name asc")
            ->get();
    }

    public function delete(int $id): bool
    {
        return User::query()->where('id', $id)->update(['status' => UserStatus::NON_ACTIVE]);
    }

    public function update(array $user): bool
    {
        $id = $user['id'];
        unset($user['id']);

        return User::query()->where('id', $id)->update($user);
    }

    public function userDetail(int $id): array
    {
        return DB::select("
            select
                users.name as name,
                users.nip as nip,
                users.phone as phone,
                users.email as email,
                users.username as username,
                roles.description as role,
                positions.name as position,
                ranks.name as ranks,
                grade_levels.name as grade,
                educations.name as education,
                departments.name as department,
                institutions.description as institution
            from users
                     left join roles on roles.id = users.role_id
                     left join positions on positions.id = users.position_id
                     left join ranks on ranks.id = users.rank_id
                     left join grade_levels on grade_levels.id = users.grade_level_id
                     left join educations on educations.id = users.education_id
                     left join departments on departments.id = users.department_id
                     left join institutions on institutions.id = users.institution_id
            where
                users.status = 'aktif' and
                users.id = ?", [$id]);
    }


}
