<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DashboardController;
use \App\Http\Controllers\ContentPageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class,'showWelcomePage'])->name('welcome');

Route::group(['middleware'=>['auth']],function (){
    Route::get('/dashboard',[DashboardController::class,'showDashboard'])->name('dashboard');
    Route::get('/pages',[ContentPageController::class,'index'])->name('pages');
    Route::post('/pages',[ContentPageController::class,'store'])->name('pages.store');
    Route::get('/pages/create',[ContentPageController::class,'create'])->name('pages.create');
    Route::delete('/pages/{slug}/delete',[ContentPageController::class,'destroy'])->name('pages.destroy');
    Route::get('/pages/{slug}/edit',[ContentPageController::class,'edit'])->name('pages.edit');
    Route::put('/pages/{slug}/update',[ContentPageController::class,'update'])->name('pages.update');
});

require __DIR__.'/auth.php';
