<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Laratrust\Models\Role;
use Laratrust\Models\Permission;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!auth()->user()->isAbleTo('user-list')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::with('roles')->paginate(10);
        return view('tenant.users.index', compact('users'));
    }

    public function create()
    {
        if (!auth()->user()->isAbleTo('user-create')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('tenant.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAbleTo('user-create')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->attachRoles($request->roles);

        return redirect()->route('tenant.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        if (!auth()->user()->isAbleTo('user-view')) {
            abort(403, 'Unauthorized action.');
        }

        return view('tenant.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->isAbleTo('user-edit')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::all();
        return view('tenant.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isAbleTo('user-edit')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,name'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => 'string|min:8|confirmed'
            ]);
            $user->update(['password' => bcrypt($request->password)]);
        }

        $user->syncRoles($request->roles);

        return redirect()->route('tenant.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->isAbleTo('user-delete')) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->id === auth()->id()) {
            return redirect()->route('tenant.users.index')
                ->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return redirect()->route('tenant.users.index')
            ->with('success', 'User deleted successfully.');
    }
} 