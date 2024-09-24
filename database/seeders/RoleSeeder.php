<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);
        $karyawan = Role::create(['name' => 'karyawan']);

        // Permissions
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage barangs']);
        Permission::create(['name' => 'view mutasi']);
        Permission::create(['name' => 'view supplier']);

        // Assign permissions to roles
        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['manage barangs', 'view mutasi']);
        $karyawan->givePermissionTo(['view mutasi']);
    }
}
