<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//temp
Route::get('/emails',function(){
    return new \App\Mail\NewUserWelcomeMail();
}
);
//follows controllers
Route::post('/follow/{user}',[FollowsController::class,'store']);


//post controllers
Route::get('/',[PostsController::class,'index']);
Route::get('/p/create', [PostsController::class, 'create']);
Route::post('/p', [PostsController::class, 'store']);
Route::get('/p/{post}', [PostsController::class, 'show']);

//profile controller
//TODO:change route to username instead of id
Route::get('/profile/{user}', [ProfilesController::class,'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class,'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [ProfilesController::class,'update'])->name('profile.update');