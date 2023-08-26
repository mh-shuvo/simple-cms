<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\ProfileController;
use App\Http\Controllers\Api\V1\Auth\PageController;

Route::middleware('api_auth:sanctum')->group(function(){

    // User Profile API
    Route::get('/user',[ProfileController::class,'user']);
    Route::post('/logout',[ProfileController::class,'logout']);

    //Get All content pages

    Route::get('/pages',[PageController::class,'getAllContentPages']);
    Route::get('/pages/{slug}/',[PageController::class,'getSingleContentPages']);

});
Route::post('/login',[LoginController::class,'login']);
