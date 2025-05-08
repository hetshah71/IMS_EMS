<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Permission;
use Exception;

class RoleController extends Controller
{
    public function index(): View|RedirectResponse
    {
        try {
            $roles = Role::all();
            return view('admin.roles.index', compact('roles'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading roles: ' . $e->getMessage());
        }
    }

    public function create(): View|RedirectResponse
    {
        try {
            $permissions = Permission::all();
            return view('admin.roles.create', compact('permissions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id'
            ]);

            $role = Role::create([
                'name' => $validated['name'],
            ]);

            if ($request->has('permissions')) {
                $role->permissions()->sync($request->permissions);
            }

            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating role: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Role $role): View|RedirectResponse
    {
        try {
            $permissions = Permission::all();
            return view('admin.roles.edit', compact('role', 'permissions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Role $role)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            ]);

            $role->update($validated);

            $role->permissions()->sync($request->permissions);
            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating role: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            $role->permissions()->detach();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting role: ' . $e->getMessage());
        }
    }
}
