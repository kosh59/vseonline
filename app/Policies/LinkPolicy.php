<?php

namespace App\Policies;

use App\User;
use App\Link;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Link $link
     * @return bool
     */
    public function DestroyOrUpdate(User $user, Link $link)
    {
        return $user->id === $link->user_id;
    }
}
