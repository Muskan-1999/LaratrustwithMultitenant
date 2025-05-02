<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class TenantLaratrustSeeder extends Seeder
{
    public function run()
    {
        $this->truncateLaratrustTables();
        $this->call(ProjectSeeder::class);

        $config = Config::get('laratrust_seeder.roles_structure');

        if ($config === null) {
            return false;
        }

        $mapPermission = collect(config('laratrust_seeder.permissions_map'));

        foreach ($config as $key => $modules) {
            // Create a new role
            $role = \App\Models\Role::firstOrCreate([
                'name' => $key,
                'display_name' => ucwords(str_replace('_', ' ', $key)),
                'description' => ucwords(str_replace('_', ' ', $key))
            ]);
            $permissions = [];

            // Reading role permission modules
            foreach ($modules as $module => $value) {
                foreach (explode(',', $value) as $perm) {
                    $permissionValue = $mapPermission->get($perm);

                    $permissions[] = \App\Models\Permission::firstOrCreate([
                        'name' => $module . '-' . $permissionValue,
                        'display_name' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                        'description' => ucfirst($permissionValue) . ' ' . ucfirst($module),
                    ])->id;
                }
            }

            // Add all permissions to the role
            $role->permissions()->sync($permissions);
        }
    }

    protected function truncateLaratrustTables()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('permission_role')->truncate();
        DB::table('permission_user')->truncate();
        DB::table('role_user')->truncate();

        if (Config::get('laratrust_seeder.truncate_tables')) {
            DB::table('roles')->truncate();
            DB::table('permissions')->truncate();
        }

        Schema::enableForeignKeyConstraints();
    }
} 