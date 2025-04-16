<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CentralDatabaseSeeder extends Seeder
{
    /**
     * Seed the central application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'user@user.com',
            'password' => 'User@123',
        ]);
    }
} 