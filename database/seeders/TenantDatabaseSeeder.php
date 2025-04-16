<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Laratrust\Models\Role;
use Laratrust\Models\Permission;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for tenants.
     */
    public function run(): void
    {
        // Create permissions for user management
        $permissions = [
            'user-list' => 'List Users',
            'user-create' => 'Create Users',
            'user-edit' => 'Edit Users',
            'user-delete' => 'Delete Users',
            'user-view' => 'View User Details',
        ];

        $permissionModels = [];
        foreach ($permissions as $name => $displayName) {
            $permission = Permission::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $displayName,
                    'description' => "Permission to {$displayName}"
                ]
            );
            $permissionModels[$name] = $permission;
        }

        // Create roles
        $roles = [
            'super-admin' => [
                'display_name' => 'Super Admin',
                'description' => 'Full access to all features',
                'permissions' => ['user-list', 'user-create', 'user-edit', 'user-delete', 'user-view']
            ],
            'admin' => [
                'display_name' => 'Admin',
                'description' => 'Can manage users but with some restrictions',
                'permissions' => ['user-list', 'user-create', 'user-edit', 'user-view']
            ],
            'manager' => [
                'display_name' => 'Manager',
                'description' => 'Can view and edit users but cannot delete',
                'permissions' => ['user-list', 'user-edit', 'user-view']
            ],
            'user' => [
                'display_name' => 'User',
                'description' => 'Basic user with limited access',
                'permissions' => ['user-list', 'user-view']
            ]
        ];

        foreach ($roles as $name => $data) {
            $role = Role::firstOrCreate(
                ['name' => $name],
                [
                    'display_name' => $data['display_name'],
                    'description' => $data['description']
                ]
            );

            // Get permission IDs for this role
            $permissionIds = [];
            foreach ($data['permissions'] as $permissionName) {
                if (isset($permissionModels[$permissionName])) {
                    $permissionIds[] = $permissionModels[$permissionName]->id;
                }
            }

            // Sync permissions (this will remove any existing permissions and add the new ones)
            $role->syncPermissions($permissionIds);
        }
    }
} 