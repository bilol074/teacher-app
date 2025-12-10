<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'admin', 'guard_name' => 'web'],
            ['name' => 'teacher', 'guard_name' => 'web'],
            ['name' => 'student', 'guard_name' => 'web'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
