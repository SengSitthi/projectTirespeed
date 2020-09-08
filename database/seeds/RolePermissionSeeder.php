<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset Cached roles and permissions
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCashedPermissions();

        // create permissions
        Permission::create(['name' => 'AddData']);
        Permission::create(['name' => 'EditData']);
        Permission::create(['name' => 'DeleteData']);
        Permission::create(['name' => 'ReadData']);
        Permission::create(['name' => 'ManageUser']);

        // create Role
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'CRM']);
        Role::create(['name' => 'Technician']);
        Role::create(['name' => 'Accountant']);
        Role::create(['name' => 'StockManager']);
        Role::create(['name' => 'Customer']);
    }
}
