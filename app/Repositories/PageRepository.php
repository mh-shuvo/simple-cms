<?php

namespace App\Repositories;

use App\Models\ContentPage;

/**
 * Class PageRepository
 * @package App\Repositories
 */
class PageRepository
{
    /**
     * Find a content page by its slug.
     *
     * @param string $slug
     * @return ContentPage
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findBySlug($slug)
    {
        return ContentPage::whereSlug($slug)->firstOrFail();
    }
}
