<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'manage_branches',
            'manage_batches',
            'mark_attendance',
            'manage_fees',
            'view_ai_insights',
            'issue_certificates',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles
        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $branchAdmin = Role::firstOrCreate(['name' => 'branch_admin']);
        $teacher = Role::firstOrCreate(['name' => 'teacher']);
        $student = Role::firstOrCreate(['name' => 'student']);
        $parent = Role::firstOrCreate(['name' => 'parent']);

        $superAdmin->givePermissionTo(Permission::all());
        $branchAdmin->givePermissionTo(['manage_batches', 'mark_attendance', 'manage_fees', 'view_ai_insights', 'issue_certificates']);
        $teacher->givePermissionTo(['mark_attendance', 'view_ai_insights']);
    }
}
