<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class PageController extends ApiBaseController
{

    public function getAllContentPages()
    {
        $pages = ContentPage::select('title','slug')->latest()->get();

        foreach ($pages as $page){
            $page->url = url('api/v1/pages/'.$page->slug);
        }
        return $this->sendResponse($pages->toArray(),"Data Found");
    }

    public function getSingleContentPages($slug)
    {
        $page = ContentPage::whereSlug($slug)->first();

        if(!$page){
            return $this->sendError("Data Not Found",[],404);
        }

        return $this->sendResponse($page->toArray(),'Data Found');

    }
}
