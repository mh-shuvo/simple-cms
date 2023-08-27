<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\SystemConstantHelper;
use App\Http\Controllers\Api\ApiBaseController;
use App\Http\Requests\PageSeoInfoUpdateRequest;
use App\Repositories\PageRepository;
use App\Services\PageService;

/**
 * Class SeoUpdateController
 * @package App\Http\Controllers\Api\V1
 */
class SeoUpdateController extends ApiBaseController
{
    protected $pageService;
    protected $pageRepository;

    /**
     * SeoUpdateController constructor.
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
     * Update the SEO information for a content page.
     *
     * @param string $slug
     * @param PageSeoInfoUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($slug, PageSeoInfoUpdateRequest $request)
    {
        try {
            // Find the content page by its slug using the repository
            $page = $this->pageRepository->findBySlug($slug);

            // Extract SEO data from the request
            $data = $request->only('meta_title', 'meta_description', 'meta_keywords');

            // Update the page's SEO information using the service
            $this->pageService->updatePage($page, $data);

            // Return a success response
            return $this->sendResponse($page, "SEO information successfully updated.");
        } catch (\Exception $exception) {
            $exceptionMessage = $exception->getMessage();

            // Handle exceptions and return an error response
            return $this->sendException($exception,
                config('app.env') == SystemConstantHelper::LOCAL_ENV
                    ? $exceptionMessage
                    : "Something went wrong. Please try again later."
            );
        }
    }
}
