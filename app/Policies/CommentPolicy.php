<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $this->check($user, $comment);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        return $this->check($user, $comment);
    }

    public function updateAndDelete(User $user, Comment $comment)
    {
        return $this->check($user, $comment);
    }

    private function check(User $user, Comment $comment){
        if($this->isAdmin($user)){
            return true;
        }
        return $user->id === $comment->user_id;
    }

    private function isAdmin(User $user){
        if($user->role_id == 1){
            return true;
        }
        return false;
    }
}
