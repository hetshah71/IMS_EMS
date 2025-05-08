<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use Exception;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'department' => 'required|string|max:255',
                'position' => 'required|string|max:255',
                // 'is_super_admin' => 'required|boolean',
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
                // 'is_super_admin' => $request->is_super_admin,
            ]);

            return redirect()->route('admin.login.form')->with('success', 'Admin registered successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error registering admin: ' . $e->getMessage())->withInput();
        }
    }
}
