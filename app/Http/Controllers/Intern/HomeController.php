<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        try {

            $intern = Auth::user()->intern;
            $tasks = Auth::user()->tasks;
            return view('interns.home', compact('intern', 'tasks'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }
}
