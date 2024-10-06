<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {

        $admin = Role::where('name', 'Admin')->first();
        $user = Role::where('name', 'User')->first();

        $permissions = [
            ['group' => 'task', 'name' => 'task.view'],
            ['group' => 'task', 'name' => 'task.create'],
            ['group' => 'task', 'name' => 'task.update'],
            ['group' => 'task', 'name' => 'task.delete'],
        ];

        foreach ($permissions as $permission) {
            $perm = Permission::firstOrCreate($permission);

            if ($admin) {
                $admin->permissions()->attach($perm->id);
            }

            if ($user) {
                $user->permissions()->attach($perm->id);
            }
        }
    }
}
