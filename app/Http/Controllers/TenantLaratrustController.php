<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Config;

class TenantLaratrustController extends Controller
{
    public function rolesAssignment()
    {
        $modelKey = Config::get('laratrust.user_models_table_key', 'id');
        
        // Get the current tenant's users
        $users = tenancy()->central(function () {
            return User::whereHas('tenants', function ($query) {
                $query->where('id', tenant()->getId());
            })->get();
        });

        return view('vendor.laratrust.panel.roles-assignment.index', [
            'models' => $users,
            'modelKey' => $modelKey,
        ]);
    }

    public function editRolesAssignment($id)
    {
        $user = tenancy()->central(function () use ($id) {
            return User::whereHas('tenants', function ($query) {
                $query->where('id', tenant()->getId());
            })->findOrFail($id);
        });

        $roles = Config::get('laratrust.models.role')::all();
        $permissions = Config::get('laratrust.models.permission')::all();

        return view('vendor.laratrust.panel.roles-assignment.edit', [
            'model' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    public function updateRolesAssignment(Request $request, $id)
    {
        $user = tenancy()->central(function () use ($id) {
            return User::whereHas('tenants', function ($query) {
                $query->where('id', tenant()->getId());
            })->findOrFail($id);
        });

        $user->syncRoles($request->get('roles') ?? []);
        $user->syncPermissions($request->get('permissions') ?? []);

        return redirect()->route('tenant.laratrust.roles-assignment.index')
            ->with('success', 'Roles and permissions assigned successfully');
    }
} 