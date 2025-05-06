<?php

namespace App\Http\Controllers\Intern;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Intern;
use Illuminate\Support\Facades\Auth;
use Exception;

class TaskController extends Controller
{
    public function index()
    {
        try {
            // Get authenticated user
            $user = Auth::user();
            // Get intern record for this user
            $intern = $user->intern;
            // Fetch all tasks for this intern
            $tasks = $intern->tasks;
            return view('interns.tasks', compact('tasks'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading tasks: ' . $e->getMessage());
        }
    }
}
