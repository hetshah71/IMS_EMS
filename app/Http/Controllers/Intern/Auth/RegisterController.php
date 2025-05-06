<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Intern;
class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('interns.auth.register');
    }
    public function register(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Check email uniqueness in users table
            'password' => 'required|string|min:8|confirmed',
            'department' => 'required|string|max:255',
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'intern',
        ]);

        // Create the corresponding intern record
        Intern::create([
            'user_id' => $user->id,
            'department' => $request->department,
        ]);

        return redirect()->route('intern.login.form')->with('success', 'Intern registered successfully.');
    }
}
