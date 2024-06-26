<?php

namespace App\Services\Impl;

use App\Services\UserService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Enums\UserRole;

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

    public function findByRoleNameAndPositionId(UserRole $roleName, mixed $positionId = null): LengthAwarePaginator
    {
        $search = [
            'role_nam' => $roleName,
            'position_id' => $positionId
        ];
        return $this
            ->findByRoleNameAndPositionIdQuery(User::query(), $search)
            ->paginate(perPage: $this->findByRoleNameAndPositionIdQuery(User::query(), $search)->count());
    }

    public function findByRoleNameAndPositionIdQuery(Builder $query, $search)
    {
        return $query->select([
                'users.id AS user_id',
                'users.name AS full_name',
                'positions.name AS position',
                'users.nip AS nip',
                'roles.name AS role',
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
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['position_id'])) {
                    $query->where('users.position_id', $search['position_id']);
                }

                if (isset($search['role_name'])) {
                    $query->where('roles.name', $search['role_name']);
                }
            });
    }

    public function exists(int $id): bool
    {
        return User::query()
            ->where('id', $id)
            ->exists();
    }

    public function existsByName(string $name): bool
    {
        return User::query()
            ->where('name', $name)
            ->exists();
    }

    public function existsByStatus(int $id, string $status): bool
    {
        return User::query()
            ->where('id', $id)
            ->where('status', $status)
            ->exists();
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
        $query = User::query();
        if ($filter['limit'] == 0) {
            $filter['limit'] = $this->searchMainQuery($query, $filter)->count();
        }

        $query = User::query();
        return $this->searchMainQuery($query, $filter)
            ->paginate(perPage: $filter['limit'], page: $filter['offset']);
    }

    private function searchMainQuery(Builder $query, $filter)
    {
        $permissibleSort = [
            'full_name' => 'users.name',
            'position' => 'positions.name',
            'nip' => 'users.nip',
            'role' => 'roles.name',
            'rank_name' => 'ranks.name',
            'grade_level' => 'grade_levels.name',
            'education' => 'educations.name',
            'department' => 'departments.name',
            'institution' => 'institutions.name',
        ];

        $search = $filter['search'];

        $sort = validateObjectSort($filter, $permissibleSort, $permissibleSort['full_name']);
        $order = $filter['order'];

        return $query->select([
            'users.id AS user_id',
            'users.name AS full_name',
            'positions.name AS position',
            'users.nip AS nip',
            'roles.name AS role',
            'ranks.name AS rank_name',
            'grade_levels.name AS grade_level',
            'educations.name AS education',
            'departments.name AS department',
            'institutions.name AS institution',
            'users.phone AS phone',
            'users.email AS email',
            'users.username AS username',
        ])
            ->leftJoin('roles', 'users.role_id' ,'=', 'roles.id')
            ->leftJoin('positions', 'users.position_id' ,'=', 'positions.id')
            ->leftJoin('ranks', 'users.rank_id' ,'=', 'ranks.id')
            ->leftJoin('grade_levels', 'users.grade_level_id' ,'=', 'grade_levels.id')
            ->leftJoin('educations', 'users.education_id' ,'=', 'educations.id')
            ->leftJoin('departments', 'users.department_id' ,'=', 'departments.id')
            ->leftJoin('institutions', 'users.institution_id' ,'=', 'institutions.id')
            ->when($search, function (Builder $query, array $search) {
                if (isset($search['status'])) {
                    $query->where('users.status', $search['status']);
                }

                if (isset($search['name'])) {
                    $user_name = '%' . $search['name'] . '%';
                    $query->whereAny(['users.name', 'users.nip'], 'LIKE', $user_name);
                }

                if (isset($search['position_id'])) {
                    $query->where('users.position_id', $search['position_id']);
                }

                if (isset($search['rank_id'])) {
                    $query->where('users.rank_id', $search['rank_id']);
                }

                if (isset($search['grade_level_id'])) {
                    $query->where('users.grade_level_id', $search['grade_level_id']);
                }

                if (isset($search['education_id'])) {
                    $query->where('users.education_id', $search['education_id']);
                }

                if (isset($search['institution_id'])) {
                    $query->where('users.institution_id', $search['institution_id']);
                }
            })
            ->orderByRaw("$sort $order");
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
                'roles.name AS role',
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
