<?php

namespace App\Repositories;

use App\Page;
use App\Link;

class LinkRepository
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  Page  $page
     * @return Collection
     */
    public function forPage(Page $page)
    {
        return Link::where('page_id', $page->id)
            ->orderBy('order_no', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
