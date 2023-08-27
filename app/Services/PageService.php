<?php

namespace App\Services;

use App\Models\ContentPage;
/**
 * Class PageService
 * @package App\Services
 */
class PageService
{
    /**
     * Search for pages based on a keyword.
     *
     * @param string $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchPages($keyword)
    {
        return ContentPage::where(function ($query) use ($keyword) {
            $query->where('title', 'like', "%$keyword%")
                ->orWhere('meta_keywords', 'like', "%$keyword%")
                ->orWhere('status', 'like', "$keyword");
        })->latest()->paginate(5);
    }

    /**
     * Create a new content page.
     *
     * @param array $data
     * @return void
     */
    public function createPage($data)
    {
        ContentPage::create($data);
    }

    /**
     * Update an existing content page.
     *
     * @param ContentPage $page
     * @param array $data
     * @return void
     */
    public function updatePage(ContentPage $page, $data)
    {
        $page->update($data);
    }

    /**
     * Delete a content page.
     *
     * @param ContentPage $page
     * @return void
     */
    public function deletePage(ContentPage $page)
    {
        $page->delete();
    }
    /**
     * Get all content pages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllContentPages($fields=['*'])
    {
        return ContentPage::select($fields)->latest()->get();
    }
}
