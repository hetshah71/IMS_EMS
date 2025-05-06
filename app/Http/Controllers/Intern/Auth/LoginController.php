<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('interns.auth.login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::guard('intern')->attempt($request->only('email', 'password'))) {
            if (Auth::guard('intern')->user()->role === 'intern') {
                return redirect()->route('intern.dashboard')->with('success', 'Logged in successfully.');
            }
            Auth::guard('intern')->logout();
            return redirect()->back()->withErrors(['email' => 'You are not an intern.']);
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('intern')->logout();
        return redirect()->route('intern.login')->with('status', 'Logged out successfully.');
    }
}
