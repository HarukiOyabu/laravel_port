<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(){
        $my_user = \Auth::user();
        $user = \Auth::user();
        //$posts = Post::all();
        
        //$posts = \Auth::user();
        //$posts = User::find(1)->posts;
        $posts = Post::where('user_id', '<>', $my_user->id)->get();
        
        $p = \Auth::user()->post;

        
        return view('posts.index',[
            'title'=>'トップページ',
            'my_user'=>$my_user,
            'user'=>$user,
            'posts'=>$posts,
            'p' => $p,
            ]);
    }



    public function create(){

        $my_user = \Auth::user();

        return view('posts.create',[
            'title'=> '編集ページ',
            'my_user'=>$my_user,

        ]);

    }


    public function store(PostRequest $request){
        
        $my_user = \Auth::user();
        $path = '';
        $path2= '';
        

        $image = $request->file('image');
        $image2 = $request->file('image2');

        if(isset($image) === true){
            $path = $image->store('postPhotos', 'public');
        }

        if(isset($image2) === true){
            $path2 =$image2->store('postPhotos', 'public');
        }

        

        Post::create([
            'user_id' => $my_user->id,
            'title' => $request->title,
            'image' => $path,
            'image2'=> $path2,
            'description' => $request->description,

        ]);

        return redirect()->route('top');
    }


    public function show($post){
        $post = Post::find($post);
        $my_user = \Auth::user();

        return view('posts.show',[
            'my_user' => $my_user,
            'title' =>'投稿詳細',
            'post' => $post,

        ]);
       
    }


    public function auth(){
        $my_user = \Auth::user();
        $posts = \Auth::user()->posts;


        return view('posts.auth',[
            'my_user' => $my_user,
            'title' =>'My_Post',
            'posts' => $posts,

        ]);
    }


    

    public function __construct()
    {
        $this->middleware('auth');
    }
}
