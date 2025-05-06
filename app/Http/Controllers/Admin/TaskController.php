<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TaskController extends Controller
{
    public function index()
    {
        try {
            $tasks = Task::with(['creator', 'interns'])->latest()->paginate(10);
            $interns = Intern::with('tasks')->get();
            return view('admin.tasks.index', compact('tasks', 'interns'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading tasks: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $interns = Intern::with('tasks')->get();
            return view('admin.tasks.create', compact('interns'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'due_date' => 'required|date',
                'status' => 'required|in:pending,in_progress,completed',
                'interns' => 'required|array|exists:interns,id'
            ]);
           

            $task = Task::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'due_date' => $validated['due_date'],
                'status' => $validated['status'],
                'created_by' => Auth::id(),
            ]);

            $task->interns()->attach($validated['interns']);

            return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating task: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Task $task)
    {
        try {
            $task->load(['creator', 'interns']);
            return view('admin.tasks.show', compact('task'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error loading task: ' . $e->getMessage());
        }
    }

    public function edit(Task $task)
    {
        $interns = Intern::all();
        $task->load('interns');
        return view('admin.tasks.edit', compact('task', 'interns'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:today',
            'status' => 'required|in:pending,in_progress,completed',
            'interns' => 'required|array|exists:interns,id'
        ]);

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'due_date' => $validated['due_date'],
            'status' => $validated['status'],
        ]);

        $task->interns()->sync($validated['interns']);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
