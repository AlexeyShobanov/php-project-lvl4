<?php

namespace App\Http\Controllers;

use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskStatusController extends Controller
{
    public function index()
    {
        $statuses = TaskStatus::paginate(self::PAGINATE_COUNT);
        return view('task_status.index', compact('statuses'));
    }

    public function create()
    {
        $this->authorize(TaskStatus::class);
        $status = new TaskStatus();
        return view('task_status.create', compact('status'));
    }

    public function store(Request $request)
    {
        $this->authorize(TaskStatus::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $existingStatus = TaskStatus::where('name', $validatedData['name'])->first();
        if ($existingStatus) {
            flash(__('flash.taskStatus.create.double'))->warning();
            return redirect()
            ->route('task_statuses.index');
        }
        TaskStatus::create($validatedData);
        flash(__('flash.taskStatus.create.success'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);
        return view('task_status.edit', ['status' => $taskStatus]);
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:task_statuses',
        ]);
        $taskStatus->fill($validatedData)
            ->save();
        flash(__('flash.taskStatus.update.success'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);
        $status->delete();
        flash(__('flash.taskStatus.remove.success'))->success();
        return redirect()->route('task_statuses.index');
    }
}
