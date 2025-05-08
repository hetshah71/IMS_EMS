<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        try {
            return view('admin.auth.login');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading login form: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt($credentials)) {
                if (Auth::guard('admin')->user()->role === 'admin') {
                    return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully.');
                }
                Auth::guard('admin')->logout();
                return redirect()->back()->withErrors(['email' => 'You are not an admin.']);
            }

            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error during login: ' . $e->getMessage())->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            if (Auth::guard('admin')->check()) {
                Auth::guard('admin')->logout();
            }
            return redirect()->route('admin.login.form')->with('status', 'Logged out successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error during logout: ' . $e->getMessage());
        }
    }
}
