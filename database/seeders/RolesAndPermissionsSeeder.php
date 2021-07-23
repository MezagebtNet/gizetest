<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions

        $permissions = [
            'system_user',
            'system_setting',
            'system_account_activate_user',

            'manage_author_subscription',
            'manage_shop_subscription',
            'manage_agent_subscription',

            'shop_data',
            'shop_agent_assignment',
            'author_data',
            'author_asign_shop',
            'author_activate_account',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'user']);

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(['manage_author_subscription', 'manage_shop_subscription', 'manage_agent_subscription']);

        //Gets permission in the Gate::before method...
        $role = Role::create(['name' => 'super-admin']);

    }
}
