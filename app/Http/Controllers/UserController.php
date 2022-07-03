<?php

namespace App\Http\Controllers;

Use App\Models\User;
use App\Models\Post;
use App\Models\Follow;
use App\Models\Place;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Http\Requests\UserSearchRequest;


class UserController extends Controller
{
    public function show($user_id){

        $my_user = \Auth::user();
        $posts = User::find($user_id)->posts()->latest()->limit(3)->get();
        $posts_all = User::find($user_id)->posts()->get();
        $user = User::find($user_id);
        $follow_users = User::find($user_id)->follow_users;
        $followers =User::find($user_id)->followers;

        return view('users.show', [
            'title'=> 'ユーザー画面',
            'my_user'=> $my_user,
            'user'=> $user,
            'follow_users' =>$follow_users,
            'followers' => $followers,
            'posts' => $posts,
            'posts_all' =>$posts_all,
        ]);

    }



    public function edit(){
        $my_user = \Auth::user();

        $user = \Auth::user();

        return view('users.edit',[
            'title' => 'ユーザー編集画面',
            'my_user' => $my_user,
            'user'=> $user,
        ]);

    }

    public function edit_image(){
        $my_user = \Auth::user();

        return view('users.edit_image',[
            'title' => 'ユーザー画面編集',
            'my_user' =>$my_user,

        ]);
        
    }


    public function update(UserRequest $request){

        
        $my_user = \Auth::user();

        
        $my_user -> update($request->only(['name', 'profile']));

       // dd($my_user);
        
        return redirect()->route('user' , \Auth::user());

    }

    public function update_image(UserImageRequest $request){

        $my_user = \Auth::user();
        
        $path='';
        $image = $request->file('image');
        
        if(isset($image) ===true){
            $path = $image->store('userPhotos','public');
            
        }
        
        if($my_user->image !==''){
            \Storage::disk('public')->delete(\Storage::url($my_user->image));
            
        }
        
        $my_user->update([
            'image'=>$path,
        ]);

        return redirect()->route('user', \Auth::user());


    }

    public function like_post(){
        $my_user = \Auth::user();
        $like_posts = \Auth::user()->likePosts;
        $places =Place::all();;

        return view('users.like_post',[
            'title' => 'Like_Posts',
            'my_user' => $my_user,
            'like_posts' => $like_posts,
            'places' => $places,

        ]);

    }


    public function like_post_index($place){
        $my_user = \Auth::user();
        $posts= \Auth::user()->likePosts()->where('place_id',$place)->latest()->get();
        $place = Place::find($place);

        return view('posts.like_post_index',[
            'my_user' => $my_user,
            'title' =>'都道府県ごとのお気に入り',
            'posts' => $posts,
            'place' => $place,
        ]);
    }


    public function user_posts($user_id){
        $my_user = \Auth::user();
        $posts = User::find($user_id)->posts()->latest()->get();
        $user = User::find($user_id);
        return view('users.post_all',[
            'title' => '全ての投稿',
            'user' => $user,
            'my_user' => $my_user,
            'posts' => $posts,
        ]);
    }

    public function user_search(UserSearchRequest $request){
        $keyword = $request->keyword;

        
        $users= User::where('name','like',"%$keyword%")->get();
       
        $my_user = \Auth::user();

        return view('users.search_index',[
            'title' => '検索結果',
            'my_user' => $my_user,
            'users' => $users,
            
        ]);
        

    }


    public function __construct()
    {
        $this->middleware('auth');
    }

}
