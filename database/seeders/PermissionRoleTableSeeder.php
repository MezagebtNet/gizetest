<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
$super_admin_permissions = Permission::all();
Role::findOrFail(1)->permissions()->sync($super_admin_permissions->pluck('id'));

$admin_permissions = $super_admin_permissions->filter(function ($permission) {
    return substr($permission->title, 0, 7) != 'system_';
});
Role::findOrFail(2)->permissions()->sync($admin_permissions->pluck('id'));

        $user_permissions = $admin_permissions->filter(function ($permission) {
return substr($permission->title, 0, 7) != 'manage_';

        });
Role::findOrFail(3)->permissions()->sync($user_permissions);

    }
}
