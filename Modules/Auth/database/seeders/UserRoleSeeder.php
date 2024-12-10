<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Auth\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Администратор',
            'Оператор',
            'Пользователь',
        ];

        foreach ($roles as $role) {
            UserRole::query()->create([
                'name' => $role,
            ]);
        }
    }
}
