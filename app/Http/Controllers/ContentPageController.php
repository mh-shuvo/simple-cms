<?php

namespace App\Http\Controllers;

use App\Helpers\SystemConstantHelper;
use App\Http\Requests\PageRequest;
use App\Models\ContentPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContentPageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContentPage::query();

        if($request->has('q')){
            $key = $request->input('q');
            $query->where(function($q) use ($key){
               $q->where('title','like',"%$key%");
               $q->orWhere('meta_keywords','like',"%$key%");
               $q->orWhere('status','like',"$key");
            });
        }

        $pages = $query->latest()->paginate(5);

        return view('pages.index',compact('pages'));
    }
    public function create()
    {
        return view('pages.create');
    }

    public function store(PageRequest $request)
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
            Session::flash('error',config('app.env') == SystemConstantHelper::LOCAL_ENV ? $exceptionMessage : "Something went wrong. Please try again later.");

            // Redirect to the form
            return redirect()->back();

        }
    }

    public function update($slug, PageRequest $request)
    {

        // Retrieve the data using slug
        $page = ContentPage::whereSlug($slug)->firstOrFail();

        try {
            // Get all input except csrf token
            $data = $request->except('_token');

            // Store data into database
            $page->update($data);

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

    public function edit($slug)
    {
        $page = ContentPage::whereSlug($slug)->firstOrFail();
        return view('pages.edit',compact('page'));
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
