<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Intern;
use App\Models\User;
use App\Models\Task;
use Exception;
use App\Http\Requests\InternsRequest;
use App\Notifications\TaskAssigned;
use Illuminate\Support\Facades\Auth;
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

    public function store(InternsRequest $request)
    {
        try {
            $request->validated();
            $user = User::create([
                'name' => $request->validated()['name'],
                'email' => $request->validated()['email'], 
                'password' => bcrypt($request->validated()['password']),
                'role'=> 'intern',
            ]);

            Intern::create([
                'user_id' => $user->id,
                'department' => $request->validated()['department'],
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

    public function update(InternsRequest $request, $id)
    {
        try {
            $intern = Intern::with('user')->findOrFail($id);

            $request->validated();

            $intern->user->update([
                'name' => $request->validated()['name'],
                'email' => $request->validated()['email'],
            ]);

            $intern->update([
                'department' => $request->validated()['department'],
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
            $tasks = Task::whereIn('status', ['pending', 'in_progress'])->get();
            $interns = Intern::all();
            return view('admin.interns.assign', compact('tasks', 'interns'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading assign form: ' . $e->getMessage());
        }
    }

    public function assignStore(Request $request)
    {
        try {
            $request->validate([
                'task_id'   => 'required|array',
                'task_id.*' => 'exists:tasks,id',
                'intern_id' => 'required|exists:interns,id',
            ]);

            $intern = Intern::findOrFail($request->intern_id);
            $taskIds = $request->task_id;
            $admin = Auth::user();

            foreach ($taskIds as $taskId) {
                $task = Task::findOrFail($taskId);

                // Attach intern to task (many-to-many)
                $task->interns()->syncWithoutDetaching([$intern->id]);

                // Update status if needed
                $task->update(['status' => 'in_progress']);

                // dd($intern);
                // Send notification
                $intern->notify(new TaskAssigned($task,$admin));
            }

            return redirect()->route('interns.index')->with('success', 'Tasks assigned and intern notified successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error assigning tasks: ' . $e->getMessage())->withInput();
        }
    }
}
