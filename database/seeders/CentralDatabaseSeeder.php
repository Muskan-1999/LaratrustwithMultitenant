<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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

        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => 'User ' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@gmail.com',
                'password' => Hash::make('password'), 
            ]);
        }

        $this->call(ProjectSeeder::class);
    }
} 