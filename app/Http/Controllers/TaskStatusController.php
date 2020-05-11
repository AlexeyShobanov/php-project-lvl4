<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TaskStatusController extends Controller
{
    
    public function index()
    {
        $statuses = TaskStatus::all();
        return view('task_status.index', compact('statuses'));
    }

    
    public function create()
    {
        $this->authorize('create', TaskStatus::class);
        return view('task_status.create');
    }

    public function store(Request $request)
    {
        $this->authorize('store', TaskStatus::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        
        if ($validator->fails()) {
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('task_statuses.create')
                ->withErrors($validator)
                ->withInput();
        }
        
        $status = $validator->valid()['name'];
        
        $existingStatus = TaskStatus::where('name', $status)->first();
        if ($existingStatus) {
            flash(__('messages.taskStatusAlreadyAdded'))->warning();
            return redirect()
            ->route('task_statuses.index');
        }

        TaskStatus::create(['name' => $status]);

        flash(__('messages.taskStatusAddedSuccessfully'))->success();

        return redirect()
            ->route('task_statuses.index');
    }
    
    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize('edit', $taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);
        return view('task_status.edit', compact('status'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize('update', $taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);

        if ($validator->fails()) {
            flash(__('messages.incorrectDataEntered'))->error();
            return redirect()
                ->route('task_statuses.edit', ['status' => request()->name])
                ->withErrors($validator)
                ->withInput();
        }

        $statusName = $validator->valid()['name'];

        $status->name = $statusName;
        $status->save();
        flash(__('messages.taskStatusUpdatedSuccessfully'))->success();

        return redirect()
            ->route('task_statuses.index');
    }

    
    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('delete', $taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);
        $status->delete();
        return redirect()->route('task_statuses.index');
    }
}
