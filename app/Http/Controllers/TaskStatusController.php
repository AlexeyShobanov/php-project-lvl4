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
        //$taskStatus = new TaskStatus();
        //return view('task_status.create', compact('status'));
        
        $this->authorize('create', TaskStatus::class);

        return view('task_status.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);
        if ($validator->fails()) {
            flash('Not a valid name')->error();
            return redirect()
            ->route('task_statuses.create');
        }
        $status = $validator->valid()['name'];
        
        $existingStatus = TaskStatus::where('name', $status)->first();
        if ($existingStatus) {
            flash('Status already added')->warning();
            return redirect()
            ->route('task_statuses.index');
        }

        TaskStatus::create(['name' => $status]);

        flash('Url added successfully')->success();

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
        ]);
        if ($validator->fails()) {
            flash('Not a valid name')->error();
            return redirect()
            ->route('task_statuses.edit', ['status' => request()->name]);
        }
        $statusName = $validator->valid()['name'];
        
        $existingStatusName = TaskStatus::where('name', $statusName)->first();
        if ($existingStatusName) {
            flash('Status already added')->warning();
            return redirect()
            ->route('task_statuses.index');
        }

        $status->name = $statusName;
        $status->save();
        flash('Url added successfully')->success();

        return redirect()
            ->route('task_statuses.index');
    }

    
    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize('delete', $taskStatus);
        $status = TaskStatus::find($taskStatus->id);
        if ($status) {
            $status->delete();
        }
        return redirect()->route('task_statuses.index');
    }
}
