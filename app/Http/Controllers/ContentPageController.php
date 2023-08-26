<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageCreateRequest;
use App\Models\ContentPage;
use App\SystemConstants;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::latest()->paginate(5);
        return view('pages.index',compact('pages'));
    }
    public function create()
    {
        return view('pages.create');
    }

    public function store(PageCreateRequest $request)
    {
        try {
            // Get all input except csrf token
            $data = $request->except('_token');

            // Store data into database
            ContentPage::create($data);

            //Set Session success flash message
            Session::flash('success','Page Successfully Saved.');

            // Redirect to the List
            return redirect()->route('pages');

        }catch (\Exception $exception){
            // Grab the error message
            $exceptionMessage = $exception->getMessage();

            // Set Session error flash message
            Session::flash('error',config('app.env') == SystemConstants::LOCAL_ENV ? $exceptionMessage : "Something went wrong. Please try again later.");

            // Redirect to the form
            return redirect()->back();

        }
    }

    public function destroy($slug):RedirectResponse
    {
        $page = ContentPage::whereSlug($slug)->first();

        /**
         * We can use another firstOrFail() instead of first(). But we don't it because if we do this the laravel
         * application automatically abort(404). That is not my concern. My concern is when laravel abort(404) int that time
         * the user can see the actual delete request path in the url section. That's can be a security issue
        */
        if(!$page){
            Session::flash('error',"You have sent invalid request.");
            return back();
        }

        $page->delete();
        Session::flash('success',"Page Successfully Deleted");
        return back();
    }
}
