<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Api\ApiBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends ApiBaseController
{

    public function user(Request $request){
        /** @var Request $request */
        return $this->sendResponse($request->user(),'User data found');
    }

    public function logout(){
        /** @var User $user */

        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return $this->sendResponse([],'Successfully Logout');
    }
}
