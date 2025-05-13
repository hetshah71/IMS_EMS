<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\AdminsRequest;
use Illuminate\Support\Facades\Hash;
use Exception;

class AdminController extends Controller
{
    public function index()
    {
        try {
            $admins = Admin::paginate(5);
            return view('admin.admins.index', compact('admins'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading admins: ' . $e->getMessage());
        }
    }
    public function create()
    {
        try {
            $roles = Role::all();
            return view('admin.admins.create', compact('roles'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }
    public function store(AdminsRequest $request)
    {
        try {
            $request->validated();
        // Create the user
        $user = User::create([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'], 
            'password' => Hash::make($request->validated()['password']),
            'role' => 'admin',
        ]);
        // Create the corresponding admin record
        Admin::create([
            'user_id' => $user->id,
            'department' => $request->validated()['department'],
            'position' => $request->validated()['position'],
        ]);
        // Sync roles to the user (not admin) to populate the role_user table
        if (isset($request->validated()['roles']) && $request->validated()['roles']) {
            $user->roles()->sync($request->validated()['roles']);
        }
            return redirect()->route('admins.index')->with('success', 'Admin created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating admin: ' . $e->getMessage())->withInput();
        }
    }
    public function edit(Admin $admin)
    {
        try {
            if($admin->user->isSuperAdmin()) {
                return redirect()->back()->with('error', 'Cannot edit super admin');
            }
            $roles = Role::all();
            return view('admin.admins.edit', compact('admin', 'roles'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }
    public function update(AdminsRequest $request, Admin $admin)
    {
        try {
            $user = User::findOrFail($admin->user_id);
        $request->validated();
        // Update the user
        $user->update([
            'name' => $request->validated()['name'],
            'email' => $request->validated()['email'],
        ]);
        // Update the admin record
        $admin->update([
            'department' => $request->validated()['department'] ?? $admin->department,
            'position' => $request->validated()['position'] ?? $admin->position ,
        ]);
        // Sync roles to the user
        if (isset($request->validated()['roles']) && $request->validated()['roles']) {
            $user->roles()->sync($request->validated()['roles']);
        }
            return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating admin: ' . $e->getMessage())->withInput();
        }
    }
    public function destroy(Admin $admin)
    {
        try {
            if($admin->user->isSuperAdmin()) {
                return redirect()->back()->with('error', 'Cannot delete super admin');
            }
            $user = User::findOrFail($admin->user_id);
        // Detach roles from the user
        $user->roles()->detach();
        // Delete the admin and user records
        $admin->delete();
        $user->delete();
            return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting admin: ' . $e->getMessage());
        }
    }
}
