<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\ApiBaseController;
use App\Repositories\PageRepository;
use App\Services\PageService;

/**
 * Class PageController
 * @package App\Http\Controllers\Api\V1\Auth
 */
class PageController extends ApiBaseController
{
    protected $pageService;
    protected $pageRepository;

    /**
     * PageController constructor.
     *
     * @param PageService $pageService
     * @param PageRepository $pageRepository
     */
    public function __construct(PageService $pageService, PageRepository $pageRepository)
    {
        $this->pageService = $pageService;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Get all content pages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllContentPages()
    {
        // Retrieve all content pages from the service
        $pages = $this->pageService->getAllContentPages(['title', 'slug']);

        // Add URLs to the pages
        foreach ($pages as $page) {
            $page->url = url('api/v1/pages/' . $page->slug);
        }

        return $this->sendResponse($pages->toArray(), "Data Found");
    }

    /**
     * Get a single content page by slug.
     *
     * @param string $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleContentPages($slug)
    {
        // Retrieve a content page by slug from the repository
        $page = $this->pageRepository->findBySlugForApi($slug);

        if (!$page) {
            return $this->sendError("Data Not Found", [], 404);
        }

        return $this->sendResponse($page->toArray(), 'Data Found');
    }
}
