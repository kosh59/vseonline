<?php

namespace App\Policies;
use App\Page;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Page $page
     * @return bool
     */

    public function isPageOwn(User $user, Page $page)
    {
        return $user->id === $page->user_id;
    }
}
