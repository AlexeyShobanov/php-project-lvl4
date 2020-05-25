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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('task_statuses.create')
                ->withErrors($validator)
                ->withInput();
        }
        $status = $validator->valid()['name'];
        $existingStatus = TaskStatus::where('name', $status)->first();
        if ($existingStatus) {
            flash(__('flash.taskStatus.create.double'))->warning();
            return redirect()
            ->route('task_statuses.index');
        }
        TaskStatus::create(['name' => $status]);
        flash(__('flash.taskStatus.create.success'))->success();
        return redirect()
            ->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);
        return view('task_status.edit', compact('status'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $this->authorize($taskStatus);
        $status = TaskStatus::findOrFail($taskStatus->id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('task_statuses.edit', ['status' => request()->name])
                ->withErrors($validator)
                ->withInput();
        }
        $statusName = $validator->valid()['name'];
        $status->name = $statusName;
        $status->save();
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
