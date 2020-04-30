<?php

namespace App\Policies;

use App\TaskStatus;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    
    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    public function edit(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    public function delete(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    public function restore(User $user, TaskStatus $taskStatus)
    {
        //
    }

    public function forceDelete(User $user, TaskStatus $taskStatus)
    {
        //
    }
}
