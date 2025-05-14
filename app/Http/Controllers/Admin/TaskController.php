<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Intern;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TasksRequest;
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

    public function store(TasksRequest $request)
    {
        try {

            $validated = $request->validated();


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
            $task->load(['creator', 'interns', 'comments.user']);
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

    public function update(TasksRequest $request, Task $task)
    {
        $validated = $request->validated();

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

    public function addComment(TasksRequest $request, Task $task)
    {
        try {
            $validated = $request->validated();

            Comment::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'content' => $validated['content']
            ]);

            return redirect()->route('tasks.edit', $task)->with('success', 'Comment added successfully.');
        } catch (Exception $e) {
            return redirect()->route('tasks.edit', $task)->with('error', 'Error adding comment: ' . $e->getMessage())->withInput();
        }
    }
}
