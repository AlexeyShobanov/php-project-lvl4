<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\TaskStatus;
use App\Policies\TaskStatusPolicy;
use App\Task;
use App\Policies\TaskPolicy;
use App\Label;
use App\Policies\LabelPolicy;
use App\Task\Comment;
use App\Policies\Task\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        TaskStatus::class => TaskStatusPolicy::class,
        Task::class => TaskPolicy::class,
        Label::class => LabelPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
