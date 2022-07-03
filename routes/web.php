<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\CommentController;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserSearchRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostImageUpdateRequest;
use App\Http\Requests\CommentRequest;

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


Route::controller(CommentController::class)->group(function (){
    Route::post('comments/create', 'store')->name('comment.store');

});


Route::controller(PostController::class)->group(function (){
    Route::get('/post/image_edit/{post}','post_image_edit')->name('post_image.edit');
    Route::get('/post/edit/{post}', 'post_edit')->name('post.edit');
    Route::delete('/posts/delete/{post}','destroy')->name('post.destroy');
    Route::get('/posts/index/{place}', 'place_post_index')->name('place.posts');
    Route::patch('/posts/{post}/toggle_like','toggleLike')->name('posts.toggle_like');
    Route::get('/posts/auth','auth')->name('post.auth');
    Route::get('/posts/show/{post}','show')->name('post.show');
    Route::post('/posts/create', 'store')->name('post.store');
    Route::get('/posts/create', 'create')->name('post.create');
    Route::get('/top', 'index')->name('top');
    Route::patch('/post/update/{post}', 'post_update')->name('post.update');
    Route::patch('/post/update_image/{post}','post_image_update')->name('post_image.update');
});





Route::controller(UserController::class)->group(function () {
    Route::post('user/search', 'user_search')->name('user.search');
    Route::get('user/like_post/{place}', 'like_post_index')->name('like.post.index');
    Route::get('/users/post/{user_id}', 'user_posts')->name('user.posts');
    Route::get('/like/menu', 'like_post')->name('like.menu');
    Route::get('user/edit_image', 'edit_image')->name('user_edit_image');
    Route::get('users/edit', 'edit')->name('user_edit');
    Route::get('/users/{user_id}', 'show')->name('user');
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
