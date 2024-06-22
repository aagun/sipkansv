<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function search(array $filter): LengthAwarePaginator
    {
        $permissibleSort = [
            ['full_name' => 'users.name'],
            ['position' => 'positions.name'],
            ['nip' => 'users.nip'],
            ['rank_name' => 'ranks.name'],
            ['grade_level' => 'grade_levels.name'],
            ['education' => 'educations.name'],
            ['department' => 'departments.name'],
            ['institution' => 'institutions.name'],
        ];

        $sort = validateSort($filter, $permissibleSort, $permissibleSort[0]['full_name']);
        $order = $filter['order'];

        return User::query()
            ->select([
                'users.name AS full_name',
                'positions.name AS position',
                'users.nip AS nip',
                'ranks.name AS rank_name',
                'grade_levels.name AS grade_level',
                'educations.name AS education',
                'departments.name AS department',
                'institutions.name AS institution',
                'users.phone AS phone',
                'users.email AS email',
                'users.username AS username',
            ])
            ->leftJoin('roles', 'roles.id' ,'=', 'users.role_id')
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
            ->orderByRaw("$sort $order")
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
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

    public function userDetail(int $id): Builder | Model | null
    {
        return User::query()
            ->select([
                'users.name AS full_name',
                'positions.name AS position',
                'users.nip AS nip',
                'ranks.name AS rank_name',
                'grade_levels.name AS grade_level',
                'educations.name AS education',
                'departments.name AS department',
                'institutions.name AS institution',
                'users.email AS email',
                'users.phone AS phone',
                'users.username AS username',
                'roles.name AS role'
            ])
            ->leftJoin('roles', 'roles.id' ,'=', 'users.role_id')
            ->leftJoin('positions', 'positions.id' ,'=', 'users.position_id')
            ->leftJoin('ranks', 'ranks.id' ,'=', 'users.rank_id')
            ->leftJoin('grade_levels', 'grade_levels.id' ,'=', 'users.grade_level_id')
            ->leftJoin('educations', 'educations.id' ,'=', 'users.education_id')
            ->leftJoin('departments', 'departments.id' ,'=', 'users.department_id')
            ->leftJoin('institutions', 'institutions.id' ,'=', 'users.institution_id')
            ->where('users.status', '=', UserStatus::ACTIVE)
            ->where('users.id', '=', $id)
            ->first();
    }


}
