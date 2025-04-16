<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::all();
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('tenants.create');
    }

    public function store(Request $request)
    {  
        try {
            $validateData = $request->validate([
                'name'=>'required|string|max:255',
                'domain'=>'required|string|max:255|unique:domains,domain',
                'email'=>'required|email|max:255',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $tenant = Tenant::create([
                'name' => $validateData['name'],
                'email' => $validateData['email'],
                'password' => $validateData['password'],
                'domain' => $validateData['domain']
            ]);

            // Create domain with proper suffix
            $domain = $validateData['domain'] . '.' . config('tenancy.central_domain');
            $tenant->domains()->create([
                'domain' => $domain
            ]);

            return redirect()->route('tenants.index')->with('success', 'Tenant created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error creating tenant: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Tenant $tenant)
    {
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }
    public function update(Request $request, Tenant $tenant)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'domain_name' => 'required|string|max:255|unique:domains,domain,' . $tenant->domains->first()->id . ',id',
                'password' => 'nullable|confirmed|min:8',
            ]);

            $tenant->name = $validateData['name'];
            $tenant->email = $validateData['email'];
            
            if (!empty($validateData['password'])) {
                $tenant->password = Hash::make($validateData['password']);
            }
            
            $tenant->save();

            $domain = $tenant->domains->first();
            // Update domain with proper suffix
            $domainWithSuffix = $validateData['domain_name'] . '.' . config('tenancy.central_domain');
            $domain->domain = $domainWithSuffix;
            $domain->save();
            
            return redirect()->route('tenants.index')->with('success', 'Tenant updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating tenant: ' . $e->getMessage())->withInput();
        }
    }
    public function destroy($id)
    {
        try {
            $tenant = Tenant::findOrFail($id);
            $tenant->delete();

            return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('tenants.index')->with('error', 'Error deleting tenant: ' . $e->getMessage());
        }
    }
} 