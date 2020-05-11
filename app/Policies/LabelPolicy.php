<?php

namespace App\Policies;

use App\Label;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
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

    public function update(User $user, Label $label)
    {
        return true;
    }

    public function edit(User $user, Label $label)
    {
        return true;
    }

    public function delete(User $user, Label $label)
    {
        return true;
    }
}
