<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;

class IdeaPolicy
{
    public function workWith(User $user, Idea $idea): bool
    {
        return $user->is($idea->user);
    }

    public function view(User $user, Idea $idea): bool
    {
        return $this->workWith($user, $idea);
    }

    public function update(User $user, Idea $idea): bool
    {
        return $this->workWith($user, $idea);
    }

    public function delete(User $user, Idea $idea): bool
    {
        return $this->workWith($user, $idea);
    }
}
