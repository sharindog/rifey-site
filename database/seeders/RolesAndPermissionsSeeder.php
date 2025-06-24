<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        /*
         *  slug            => [Название,                список прав]
         */
        $map = [
            'admin-it'        => ['Администраторы (ИТиС)',       [
                'news.view', 'news.manage', 'appeals.view', 'appeals.manage',
            ]],

            'quality-control' => ['Группа контроля качества',    [
                'appeals.view','appeals.manage',
            ]],

            'general-dept'    => ['Общий отдел',                 [
                'appeals.view',
            ]],

            'pr-service'      => ['PR-служба',                   [
                'news.view','news.manage','appeals.view',
            ]],
        ];

        foreach ($map as $slug => [$name, $perms]) {

            /** @var Role $role */
            $role               = Role::updateOrCreate(['slug' => $slug], ['name' => $name]);
            $role->permissions  = collect($perms)->mapWithKeys(
                fn ($p) => [$p => true]
            )->toArray();
            $role->save();
        }
    }
}
