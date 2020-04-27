<?php

namespace App\Policies;

use App\TaskStatus;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
{
    use HandlesAuthorization;

    /* public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    } */
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\TaskStatus  $taskStatus
     * @return mixed
     */
    public function view(User $user, TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\TaskStatus  $taskStatus
     * @return mixed
     */
    public function update(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    public function edit(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TaskStatus  $taskStatus
     * @return mixed
     */
    public function delete(User $user, TaskStatus $taskStatus)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\TaskStatus  $taskStatus
     * @return mixed
     */
    public function restore(User $user, TaskStatus $taskStatus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TaskStatus  $taskStatus
     * @return mixed
     */
    public function forceDelete(User $user, TaskStatus $taskStatus)
    {
        //
    }
}
