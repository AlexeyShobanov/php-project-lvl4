<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Label;
use App\Color;
use App\Task\Comment;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $filter = $data['filter'] ?? [];
        $filterStatusBar = '';
        if ($filter) {
            $filterStatusBar = implode(
                '&',
                array_reduce(array_keys($filter), function ($acc, $filterKey) use ($filter) {
                    return $filterKey != 'label_id' ?
                    array_merge($acc, ["filter%5B{$filterKey}%5D={$filter[$filterKey]}"]) :
                    $acc;
                },
                [])
            );
        }
        $statuses = TaskStatus::select('id', 'name')->get()->pluck('name', 'id')->all();
        $users = User::select('id', 'name')->get()->pluck('name', 'id')->all();
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('label_id')
            ])
            ->paginate(self::PAGINATE_COUNT);
        return view('task.index', compact('tasks', 'statuses', 'users', 'filter', 'filterStatusBar'));
    }

    public function create()
    {
        $this->authorize('create', Task::class);
        $task = new Task();
        $statuses = TaskStatus::select('id', 'name')->get()->pluck('name', 'id')->all();
        $users = User::select('id', 'name')->get()->pluck('name', 'id')->all();
        $labels = Label::select('id', 'name')->get()->pluck('name', 'id')->all();
        $defaultStatus = array_search(__('messages.new'), $statuses) ?? null;
        return view('task.create', compact('task', 'statuses', 'users', 'labels', 'defaultStatus'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Task::class);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status_id' => 'required'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('tasks.create')
                ->withErrors($validator)
                ->withInput();
        }
        $task = $validator->valid();
        $created_by_id = Auth::user()->id;
        Task::create(array_merge($task, ['created_by_id' => $created_by_id]));
        flash(__('flash.task.create.success'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        $comments = Comment::paginate(self::PAGINATE_COUNT);
        return view('task.show', compact('task', 'comments'));
    }

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
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
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('tasks.update')
                ->withErrors($validator)
                ->withInput();
        }
        $data = $validator->valid();
        $task->fill($data)
            ->save();
        flash(__('flash.task.update.success'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        flash(__('flash.task.remove.success'))->success();
        return redirect()
            ->route('tasks.index');
    }
}
