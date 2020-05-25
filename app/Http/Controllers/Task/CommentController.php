<?php

namespace App\Http\Controllers\Task;

use App\Task;
use App\Task\Comment;
use App\User;
use App\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Auth;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $this->authorize(Task::class);
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:3'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('tasks.show', compact('task'))
                ->withErrors($validator)
                ->withInput();
        }
        $comment = $validator->valid();
        $created_by_id = Auth::user()->id;
        Task\Comment::create(array_merge($comment, ['created_by_id' => $created_by_id], ['task_id' => $task->id]));
        flash(__('flash.comment.create.success'))->success();
        return redirect()
            ->route('tasks.show', compact('task'));
    }


    public function edit(Task $task, Comment $comment)
    {
        $this->authorize($comment);
        $status = TaskStatus::findOrFail($comment->id);
        return view('comment.edit', compact('comment', 'task'));
    }

    public function update(Request $request, Task $task, Comment $comment)
    {
        $this->authorize($comment);
        $validator = Validator::make($request->all(), [
            'content' => 'required|string|min:3'
        ], self::MESSAGES);
        if ($validator->fails()) {
            flash(__('flash.commonPhrases.wrongInput'))->error();
            return redirect()
                ->route('comments.edit', compact('comment', 'task'))
                ->withErrors($validator)
                ->withInput();
        }
        $content = $validator->valid()['content'];
        $comment->content = $content;
        $comment->save();
        flash(__('flash.comment.update.success'))->success();
        return redirect()
            ->route('tasks.show', compact('task'));
    }

    public function destroy(Task $task, Comment $comment)
    {
        $this->authorize($comment);
        $comment->delete();
        flash(__('flash.comment.remove.success'))->success();
        return redirect()
            ->route('tasks.show', compact('task'));
    }
}
