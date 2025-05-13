<?php

namespace App\Http\Controllers\Intern\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Intern;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    //
    public function showRegistrationForm()
    {
        return view('interns.auth.register');
    }
    public function register(RegisterRequest $request)
    {
        try {
            // Validate the request
            $credentials = $request->validated();   
            // Create the user
            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
                'role' => 'intern',
            ]);
            // Create the corresponding intern record
            Intern::create([
                'user_id' => $user->id,
                'department' => $credentials['department'],
            ]);
            return redirect()->route('intern.login.form')->with('success', 'Intern registered successfully.');
        } catch (\Exception $e) {
            Log::error('Error in RegisterController@register: ' . $e->getMessage());
            return redirect()->back()->withErrors(['email' => 'An error occurred during registration.']);
        }
    }
}
