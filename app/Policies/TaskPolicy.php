<?php

namespace App\Policies;

use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;
    
    public function create(User $user)
    {
        return true;
    }

    public function store(User $user)
    {
        return true;
    }

    public function update(User $user, Task $task)
    {
        return true;
    }

    public function edit(User $user, Task $task)
    {
        return true;
    }

    public function delete(User $user, Task $task)
    {
        return $user->id == $task->created_by_id;
    }
}
