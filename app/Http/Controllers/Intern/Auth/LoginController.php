<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Auth\LoginRequest;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('interns.auth.login');
    }

    public function login(LoginRequest $request)
    {
        try {
            // Validate the request
            $credentials = $request->validated();
            // Attempt to log the user in
            if (Auth::guard('intern')->attempt($credentials)) {
                if (Auth::guard('intern')->user()->role === 'intern') {
                    return redirect()->route('intern.dashboard')->with('success', 'Logged in successfully.');
                }
                Auth::guard('intern')->logout();
                return redirect()->back()->withErrors(['email' => 'You are not an intern.']);
            }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        } catch (\Exception $e) {
            Log::error('Error in LoginController@login: ' . $e->getMessage());
            return redirect()->back()->withErrors(['email' => 'An error occurred during login.']);
        }
    }

    public function logout(Request $request)
    {
        try {
            Auth::guard('intern')->logout();
            return redirect()->route('intern.login')->with('success', 'Logged out successfully.');
        } catch (\Exception $e) {
            Log::error('Error in LoginController@logout: ' . $e->getMessage());
            return redirect()->back()->withErrors(['message' => 'An error occurred during logout.']);
        }
    }
}
