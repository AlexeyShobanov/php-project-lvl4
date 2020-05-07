<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Label;
use App\Color;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = \DB::table('tasks')
        ->join('users as u1', 'u1.id', '=', 'tasks.created_by_id')
        ->join('task_statuses', 'task_statuses.id', '=', 'tasks.status_id')
        ->leftJoin('users as u2', 'u2.id', '=', 'tasks.assigned_to_id')
        ->leftJoin('labels', 'labels.id', '=', 'tasks.label_id')
        ->leftJoin('colors', 'colors.id', '=', 'labels.color_id')
        ->select(
            'tasks.*',
            'u1.name as created_by_name',
            'task_statuses.name as status_name',
            'u2.name as assigned_to_name',
            'labels.name as label_name',
            'colors.btn_style as label_style'
        )
        ->get();
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);

        $statuses = TaskStatus::select('id', 'name')->get()->pluck('name', 'id')->all();
        $users = User::select('id', 'name')->get()->pluck('name', 'id')->all();
        $labels = Label::select('id', 'name')->get()->pluck('name', 'id')->all();
        return view('task.create', compact('statuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {

        $this->authorize('store', Task::class);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status_id' => 'required'
        ], self::MESSAGES);
        
        if ($validator->fails()) {
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('tasks.create')
                ->withErrors($validator)
                ->withInput();
        }
    
        $task = $validator->valid();

        $created_by_id = Auth::user()->id;
        Task::create(array_merge($task, ['created_by_id' => $created_by_id]));

        flash(__('messages.taskAddedSuccessfully'))->success();

        return redirect()
            ->route('tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    public function edit(Task $task)
    {
        $this->authorize('edit', $task);
        $statuses = TaskStatus::select('id', 'name')->get()->pluck('name', 'id')->all();
        $users = User::select('id', 'name')->get()->pluck('name', 'id')->all();
        $labels = Label::select('id', 'name')->get()->pluck('name', 'id')->all();
        return view('task.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status_id' => 'required'
        ], self::MESSAGES);
        
        if ($validator->fails()) {
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('tasks.update')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->valid();
        $task->fill($data)
            ->save();

        flash(__('messages.taskUpdatedSuccessfully'))->success();

        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        if ($task) {
            $task->delete();
        }
        return redirect()
            ->route('tasks.index');
    }
}
