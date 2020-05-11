<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function store(User $user)
    {
        return true;
    }

    public function edit(User $user, Comment $comment)
    {
        return $user->id == $comment->created_by_id;
    }

    public function update(User $user, Comment $comment)
    {
        return $user->id == $comment->created_by_id;
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id == $comment->created_by_id;
    }
}
