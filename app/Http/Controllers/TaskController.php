<?php

namespace App\Http\Controllers;

use DateTime;
use DateInterval;
use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class TaskController extends Controller
{
    public function store(TaskStoreRequest $request)
    {
        $task = Task::create(array_merge($request->validated(), ['user_id' => Auth::user()->id]));
        $date = new DateTime($task['task_date']);

        session()->flash('message', 'Task was created successfully');

        return to_route('dashboard', [$date->format('Y-m-d')]);
    }
}
