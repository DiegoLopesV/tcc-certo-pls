<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        
        $adminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);
        
        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-produto',
            'edit-produto',
            'delete-produto',
        ]);
        
        $userRole->givePermissionTo([
            'create-produto',
            'edit-produto',
            'delete-produto',
        ]);
    }
}
