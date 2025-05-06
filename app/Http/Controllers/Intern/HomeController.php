<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $intern = auth()->user()->intern;
            $tasks = auth()->user()->tasks;
            return view('interns.home', compact('intern', 'tasks'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }
}
