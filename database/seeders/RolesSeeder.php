<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        Role::query()->updateOrCreate([
            'slug' => 'it',
        ], [
            'name' => 'Отдел информационных технологий и связи',
            'permissions' => ['platform.index' => true]
    ]);
        Role::query()->updateOrCreate([
            'slug' => 'pr',
            ], [
            'name' => 'Группа по связям с общественностью',
            'permissions' => []
        ]);
        Role::query()->updateOrCreate([
            'slug' => 'general',
            ], [
            'name' => 'Общий отдел',
            'permissions' => []
        ]);
    }
}
