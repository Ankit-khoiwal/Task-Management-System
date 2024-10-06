<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function dashboard(Request $request)
    {

        $user = auth()->user();

        if ($user->role->name === 'Admin') {
            $tasks = Task::all();
        } else {
            $tasks = $user->tasks()->get();
        }

        return view('admin.pages.index', compact('tasks'));
    }

}
