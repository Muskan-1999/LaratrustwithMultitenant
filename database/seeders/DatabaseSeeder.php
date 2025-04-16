<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (config('database.default') === config('tenancy.database.central_connection', 'central')) {
            // We're seeding the central database
            $this->call(CentralDatabaseSeeder::class);
        } else {
            // We're seeding a tenant database
            $this->call(TenantDatabaseSeeder::class);
        }
    }
}
