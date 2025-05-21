<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions List
        $permissions = [
            'manage_users',
            'manage_roles',
            'manage_permissions',
            'view_reports',
            'manage_branches',
            'manage_trainers',
            'manage_members',
            'manage_memberships',
            'manage_classes',
            'manage_attendance',
            'manage_payments',
            'view_own_attendance',
            'view_own_workouts',
        ];

        // Create and store permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Roles and their respective permissions
        $roles = [
            'SuperAdmin' => Permission::all(),
            'BranchManager' => [
                'manage_trainers',
                'manage_members',
                'manage_memberships',
                'manage_classes',
                'manage_attendance',
                'view_reports',
                'manage_payments',
            ],
            'Trainer' => [
                'manage_classes',
                'manage_attendance',
                'view_own_workouts',
            ],
            'Receptionist' => [
                'manage_members',
                'manage_memberships',
                'manage_payments',
                'manage_attendance',
            ],
            'Member' => [
                'view_own_attendance',
                'view_own_workouts',
            ],
        ];

        // Create roles and assign permissions
        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            if (is_array($perms)) {
                $role->syncPermissions($perms);
            } else {
                $role->syncPermissions(Permission::all());
            }
        }

        $this->command->info('Roles and Permissions seeded successfully.');
    }
}
