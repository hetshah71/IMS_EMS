<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(5);
        return view('admin.admins.index', compact('admins'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'roles' => 'required|array', // Ensure roles are provided
            'roles.*' => 'exists:roles,id', // Validate each role ID exists
        ]);
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
        ]);
        // Create the corresponding admin record
        Admin::create([
            'user_id' => $user->id,
            'department' => $request->department,
            'position' => $request->position,
        ]);
        // Sync roles to the user (not admin) to populate the role_user table
        if ($request->has('roles')) {
            $user->roles()->sync($request->input('roles'));
        }
        return redirect()->route('admins.index')->with('success', 'Admin created successfully');
    }
    // public function show(Admin $admin)
    // {
    //     return view('admin.admins.show', compact('admin'));
    // }
    public function edit(Admin $admin)
    {
        $roles = Role::all();
        return view('admin.admins.edit', compact('admin', 'roles'));
    }
    public function update(Request $request, Admin $admin)
    {
        $user = User::findOrFail($admin->user_id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id, // Exclude current user's email
            'password' => 'nullable|string|min:8',
            'department' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);
        // Update the user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
        // Update the admin record
        $admin->update([
            'department' => $request->department,
            'position' => $request->position,
        ]);
        // Sync roles to the user
        $user->roles()->sync($request->input('roles'));
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully');
    }
    public function destroy(Admin $admin)
    {
        $user = User::findOrFail($admin->user_id);
        // Detach roles from the user
        $user->roles()->detach();
        // Delete the admin and user records
        $admin->delete();
        $user->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully');
    }
}
