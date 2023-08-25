<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ContentPageController extends Controller
{
    public function index()
    {
        Session::flash('error',"Successfully Deleted");
        $pages = ContentPage::latest()->paginate(5);
        return view('pages.index',compact('pages'));
    }
    public function create()
    {
        return view('pages.create');
    }

    public function destroy($id)
    {

    }
}
