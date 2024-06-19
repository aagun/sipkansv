<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface UserService
{
    public function findOne(int $id): Builder | Model | null;

    public function findByName(string $name): Builder | Model | null;

    public function exists(int $id): bool;

    public function existsByName(string $name): bool;

    public function save(array $user): Builder | Model;

    public function saveAll(array $users): void;

    public function search(array $filter);

    public function delete(int $id);

    public function update(array $user);

    public function userDetail(int $id);
}
