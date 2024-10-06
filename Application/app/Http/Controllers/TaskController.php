<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(!userCan('task.view'), 403);

        $searchQuery = $request->q;
        $user = auth()->user();

        if ($user->role->name === 'Admin') {
            $tasksQuery = Task::query();
        } else {
            $tasksQuery = $user->tasks();
        }

        if ($searchQuery) {
            $tasksQuery->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%');
            });
        }

        $taskCount = $tasksQuery->count();
        $tasks = $tasksQuery->paginate(10);

        return view('admin.pages.tasks.index', compact('tasks', 'taskCount'));
    }




    public function create()
    {
        abort_if(!userCan('task.create'), 403);

        $users = User::select('id', 'name')->get();
        return view('admin.pages.tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        abort_if(!userCan('task.create'), 403);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,jpg,png,gif|max:10240',
            'user_id' => 'required|integer'
        ]);

        $documentPath = null;

        if ($request->hasFile('document')) {

            $directoryPath = public_path('Uploads/Tasks');

            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            $documentPath = $request->file('document')->store('Tasks', 'public');

            $request->file('document')->move($directoryPath, $documentPath);
        }

        if ($documentPath) {
            $validated['document'] = 'Uploads/Tasks/' . basename($documentPath);
        }

        auth()->user()->tasks()->create($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task created successfully.');
    }


    public function edit(Task $task)
    {
        abort_if(!userCan('task.update'), 403);
        abort_if(empty($task), 404);

        $user = auth()->user();

        if ($user->role->name !== 'Admin' && $task->user_id !== $user->id) {
            abort(403);
        }

        $users = User::select('id', 'name')->get();

        return view('admin.pages.tasks.edit', compact('task', 'users'));
    }




    public function update(Request $request, Task $task)
    {

        abort_if(!userCan('task.update'), 403);

        $validated = $request->merge([
            'user_id' => (int) $request->user_id
        ])->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deadline' => 'required|date',
            'status' => 'required|in:pending,completed',
            'document' => 'nullable|file|mimes:pdf,doc,docx,jpeg,jpg,png,gif|max:10240',
            'user_id' => 'required|integer|exists:users,id'
        ]);


        $documentPath = null;

        if ($request->hasFile('document')) {

            $directoryPath = public_path('Uploads/Tasks');

            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }

            $documentPath = $request->file('document')->store('Tasks', 'public');

            $request->file('document')->move($directoryPath, $documentPath);
        }

        if ($documentPath) {
            $validated['document'] = 'Uploads/Tasks/' . basename($documentPath);
        }

        $task->update($validated);

        return redirect()->route('admin.tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        abort_if(!userCan('task.delete'), 403);

        $task->delete();
        return redirect()->route('admin.tasks.index')->with('success', 'Task deleted successfully.');
    }
}
