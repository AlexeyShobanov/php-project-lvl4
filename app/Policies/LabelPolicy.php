<?php

namespace App\Policies;

use App\Label;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
{
    use HandlesAuthorization;

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
     * @param  \App\Label  $label
     * @return mixed
     */
    public function update(User $user, Label $label)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Label  $label
     * @return mixed
     */
    public function delete(User $user, Label $label)
    {
        return true;
    }
}
