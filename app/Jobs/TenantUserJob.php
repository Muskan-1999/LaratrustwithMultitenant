<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\TenantLaratrustSeeder;

class TenantUserJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tenant;

    /**
     * Create a new job instance.
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->tenant->run(function () {
            // First seed the roles in the tenant database
            $seeder = new TenantLaratrustSeeder();
            $seeder->run();

            $user = User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => $this->tenant->password // Password is already hashed in Tenant model
            ]);

            // Assign admin role if needed
            $user->addRole('administrator');
        });
    }
}
