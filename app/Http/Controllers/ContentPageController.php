<?php

namespace App\Http\Controllers;

use App\Helpers\SystemConstantHelper;
use App\Http\Requests\PageRequest;
use App\Models\ContentPage;
use App\Repositories\PageRepository;
use App\Services\PageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
/**
 * Class ContentPageController
 * @package App\Http\Controllers
 */
class ContentPageController extends Controller
{
    /**
     * @var PageService
     */
    private $pageService;
    /**
     * @var PageRepository
     */
    private $pageRepository;

    /**
     * ContentPageController constructor.
     * @param PageService $pageService
     * @param PageRepository $pageRepository
     */

    public function __construct(PageService $pageService, PageRepository $pageRepository)
    {
        $this->pageService = $pageService;
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->has('q')) {
            $keyword = $request->input('q');
            $pages = $this->pageService->searchPages($keyword);
        } else {
            $pages = $this->pageService->searchPages('');
        }

        return view('pages.index', compact('pages'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
        try {

            $data = $request->except('_token');
            $this->pageService->createPage($data);


            //Set Session success flash message
            Session::flash('success','Page Successfully Saved.');

            // Redirect to the List
            return redirect()->route('pages');

        }catch (\Exception $exception){
            // Grab the error message
            $exceptionMessage = $exception->getMessage();

            // Set Session error flash message
            Session::flash('error',config('app.env') == SystemConstantHelper::LOCAL_ENV ? $exceptionMessage : "Something went wrong. Please try again later.");

            // Redirect to the form
            return redirect()->back();

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $slug
     * @param PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($slug, PageRequest $request)
    {
        try {

            $page = $this->pageRepository->findBySlug($slug);
            $data = $request->except('_token');
            $this->pageService->updatePage($page, $data);

            //Set Session success flash message
            Session::flash('success','Page Successfully Updated.');

            // Redirect to the edit
            return redirect()->route('pages.edit',[$page->slug]);

        }catch (\Exception $exception){
            // Grab the error message
            $exceptionMessage = $exception->getMessage();

            // Set Session error flash message
            Session::flash('error',config('app.env') == SystemConstantHelper::LOCAL_ENV ? $exceptionMessage : "Something went wrong. Please try again later.");

            // Redirect to the form
            return redirect()->back();

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($slug)
    {
        $page = $this->pageRepository->findBySlug($slug);
        return view('pages.edit',compact('page'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($slug):RedirectResponse
    {
        try {
            $page = $this->pageRepository->findBySlug($slug);
            $this->pageService->deletePage($page);
            Session::flash('success', 'Page Successfully Deleted.');
            return back();
        } catch (\Exception $exception) {
            // Grab the error message
            $exceptionMessage = $exception->getMessage();

            // Set Session error flash message
            Session::flash('error',config('app.env') == SystemConstantHelper::LOCAL_ENV ? $exceptionMessage : "Something went wrong. Please try again later.");

            // Redirect to the form
            return redirect()->back();
        }
    }
}
