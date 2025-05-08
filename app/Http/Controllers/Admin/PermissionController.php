<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Exception;

class PermissionController extends Controller
{
    public function index(): View|RedirectResponse
    {
        try {
            $permissions = Permission::all();
            return view('admin.permissions.index', compact('permissions'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading permissions: ' . $e->getMessage());
        }
    }

    public function create(): View|RedirectResponse
    {
        try {
            return view('admin.permissions.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions',
                'slug' => 'required',
            ]);

            Permission::create($validated);

            return redirect()->route('permissions.index')
                ->with('success', 'Permission created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating permission: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Permission $permission): View|RedirectResponse
    {
        try {
            return view('admin.permissions.edit', compact('permission'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name',
                'slug' => 'required',
            ]);

            $permission->update($validated);

            return redirect()->route('permissions.index')
                ->with('success', 'Permission updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating permission: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $permission->delete();

        return redirect()->route('permissions.index')
            ->with('success', 'Permission deleted successfully.');
    }
}
