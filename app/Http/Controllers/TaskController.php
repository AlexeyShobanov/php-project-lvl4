<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Label;
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
    private const DEFAULT_STATUS = 'New';

    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $tasks = QueryBuilder::for(Task::class)
            ->allowedFilters([
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id'),
                AllowedFilter::exact('status_id'),
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE_COUNT);
        return view('task.index', compact('tasks', 'statuses', 'users', 'labels', 'filter'));
    }

    public function create()
    {
        $this->authorize(Task::class);
        $task = new Task();
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $defaultStatus = $statuses->search(self::DEFAULT_STATUS) ?? null;
        return view('task.create', compact('task', 'statuses', 'users', 'labels', 'defaultStatus'));
    }

    public function store(Request $request)
    {
        $this->authorize(Task::class);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status_id' => 'required|integer',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer'
        ]);
        $created_by_id = Auth::user()->id;
        $task = Task::create(array_merge($validatedData, ['created_by_id' => $created_by_id]));
        $labels = Label::find($request->input('labels_id'));
        if (($labels)) {
            $task->labels()->attach($labels);
        }
        flash(__('flash.task.create.success'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function show(Task $task)
    {
        //$comments = Comment::get()->sortByDesc('id');
        $comments = $task->comments()
            ->orderBy('created_at', 'desc')
            ->paginate(self::PAGINATE_COUNT);
        return view('task.show', compact('task', 'comments'));
    }

    public function edit(Task $task)
    {
        $this->authorize($task);
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');
        $selectedLabels = $task->labels->pluck('id')->all();
        return view('task.edit', compact('task', 'statuses', 'users', 'labels', 'selectedLabels'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize($task);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status_id' => 'required|integer',
            'description' => 'nullable|string',
            'assigned_to_id' => 'nullable|integer'
        ]);
        $task->fill($validatedData)
            ->save();
        $labels = Label::find($request->input('labels_id'));
        $savedLabels = $task->labels;
        $outdatedLabels = $savedLabels ? $savedLabels->diffAssoc($labels) : null;
        if (($outdatedLabels)) {
            $task->labels()->detach($outdatedLabels);
        }
        $newLabels = $labels ? $labels->diffAssoc($savedLabels) : null;
        if (($newLabels)) {
            $task->labels()->attach($newLabels);
        }
        flash(__('flash.task.update.success'))->success();
        return redirect()
            ->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $this->authorize($task);
        $task->delete();
        flash(__('flash.task.remove.success'))->success();
        return redirect()
            ->route('tasks.index');
    }
}
