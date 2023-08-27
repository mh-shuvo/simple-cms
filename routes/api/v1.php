<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\SeoUpdateController;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */

Route::post('/login',[LoginController::class,'login']);

//Get All content pages

Route::get('/pages',[PageController::class,'getAllContentPages']);
Route::get('/pages/{slug}/',[PageController::class,'getSingleContentPages']);

/**
 * Private Routes
*/
Route::middleware('api_auth:sanctum')->group(function(){

    // User Profile
    Route::get('/user',[ProfileController::class,'user']);
    Route::post('/logout',[ProfileController::class,'logout']);

    // SEO Update

    Route::put('/seo/{slug}/update',[SeoUpdateController::class,'update']);
});
