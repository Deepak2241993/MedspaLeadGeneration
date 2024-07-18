<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $salesTeamRole = Role::create(['name' => 'sales-team']);
        $accountTeamRole = Role::create(['name' => 'account-team']);

        // Define permissions (add as needed)
        Permission::create(['name' => 'view sales data']);
        Permission::create(['name' => 'manage accounts']);

        // Assign permissions to roles
        $superAdminRole->givePermissionTo(Permission::all());
        $salesTeamRole->givePermissionTo('view sales data');
        $accountTeamRole->givePermissionTo('manage accounts');
    }
}

