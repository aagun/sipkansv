<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'RO_ADMIN',
                'description' => 'Administrator'
            ],
            [
                'name' => 'RO_SUPERVISOR',
                'description' => 'Role untuk pengawas'
            ],
            [
                'name' => 'RO_OPERATOR',
                'description' => 'Role untuk pengelola data'
            ],
            [
                'name' => 'RO_HEAD',
                'description' => 'Rolea untuk pimpinan'
            ]
        ];

        foreach ($roles as $role) {
            Role::query()->create($role);
        }
    }
}
