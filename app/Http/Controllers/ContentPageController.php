<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\Http\Request;
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

    public function destroy($slug)
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
