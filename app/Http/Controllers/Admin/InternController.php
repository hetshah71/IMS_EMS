<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use App\Models\User;
use App\Models\Task;
use Exception;

class InternController extends Controller
{
    public function index()
    {
        try {
            $interns = Intern::paginate(10);
            return view('admin.interns.index', compact('interns'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading interns: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            return view('admin.interns.create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Intern::create([
                'user_id' => $user->id,
                'department' => $request->department,
            ]);

            return redirect()->route('interns.index')->with('success', 'Intern created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating intern: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        try {
            $intern = Intern::with('user')->findOrFail($id);
            return view('admin.interns.show', compact('intern'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading intern: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $intern = Intern::with('user')->findOrFail($id);
            return view('admin.interns.edit', compact('intern'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $intern = Intern::with('user')->findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $intern->user->id,
                'department' => 'required|string|max:255',
            ]);

            $intern->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $intern->update([
                'department' => $request->department,
            ]);

            return redirect()->route('interns.index')->with('success', 'Intern updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error updating intern: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $intern = Intern::findOrFail($id);
            $user = $intern->user;

            $intern->delete();
            $user->delete();

            return redirect()->route('interns.index')->with('success', 'Intern deleted successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error deleting intern: ' . $e->getMessage());
        }
    }

    public function assign()
    {
        try {
            $tasks = Task::where('status', 'pending')->get();
            $interns = Intern::all();
            return view('admin.interns.assign', compact('tasks', 'interns'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading assign form: ' . $e->getMessage());
        }
    }

    public function assignStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'intern_id' => 'required|exists:interns,id',
                'task_id' => 'required|exists:tasks,id'
            ]);

            $task = Task::find($validated['task_id']);
            $task->interns()->attach($validated['intern_id']);
            $task->update(['status' => 'in_progress']);

            return redirect()->route('interns.index')->with('success', 'Task assigned successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error assigning task: ' . $e->getMessage())->withInput();
        }
    }
}
