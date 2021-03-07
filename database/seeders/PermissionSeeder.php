<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'access-admin']);
        Permission::create(['name' => 'access-myaccount']);
        Permission::create(['name' => 'access-contact']);
        Permission::create(['name' => 'access-viewusers']);
        Permission::create(['name' => 'access-editusers']);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo('access-admin');
        $admin->givePermissionTo('access-myaccount');
        $admin->givePermissionTo('access-contact');
        $admin->givePermissionTo('access-viewusers');
        $admin->givePermissionTo('access-editusers');

        $subadmin = Role::create(['name' => 'subadmin']);
        $subadmin->givePermissionTo('access-myaccount');
        $subadmin->givePermissionTo('access-contact');
        $subadmin->givePermissionTo('access-viewusers');

        $user = Role::create(['name' => 'user']);
        $subadmin->givePermissionTo('access-myaccount');
        $subadmin->givePermissionTo('access-contact');
    }
}
