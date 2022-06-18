<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Requests\UserRequest;
use App\Http\Requests\PostRequest;

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

Route::get('/', function () {
    return view('welcome');
});



Route::controller(PostController::class)->group(function (){

    Route::patch('/posts/{post}/toggle_like','toggleLike')->name('posts.toggle_like');
    Route::get('/posts/auth','auth')->name('post.auth');
    Route::get('/posts/show{post}','show')->name('post.show');
    Route::post('posts/create', 'store')->name('post.store');
    Route::get('/posts/create', 'create')->name('post.create');
    Route::get('/top', 'index')->name('top');
});





Route::controller(UserController::class)->group(function () {
    
    Route::get('user/edit_image', 'edit_image')->name('user_edit_image');
    Route::get('users/edit', 'edit')->name('user_edit');
    Route::get('/users/{user_id}', 'index')->name('user');
    Route::patch('/profile', 'update')->name('profile.update');
    Route::patch('/profile/edit_image', 'update_image')->name('profile.update_image');
    
    
});



Route::controller(FollowController::class)->group(function (){
    Route::get('followers', 'followers_index')->name('followers.index');
    Route::get('/follows', 'index')->name('follows.index');
    Route::post('/follows' , 'store')->name('follows.store');
    Route::delete('/follows/{id}' , 'destroy')->name('follows.destory');
});




Auth::routes();
