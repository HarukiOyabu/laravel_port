<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Place;
use App\Models\Comment;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Requests\PostImageUpdateRequest;

class PostController extends Controller
{
    public function index(){
        $my_user = \Auth::user();
        $user = \Auth::user();
        $places = Place::all();
       
        $posts = Post::where('user_id', '<>', $my_user->id)->latest()->limit(10)->get(); 
        

        
        return view('posts.index',[
            'title'=>'トップページ',
            'my_user'=>$my_user,
            'user'=>$user,
            'posts'=>$posts,
            'places'=>$places,
            ]);
    }



    public function create(){

        $my_user = \Auth::user();
        $places = Place::all();

        return view('posts.create',[
            'title'=> '新規投稿',
            'my_user'=>$my_user,
            'places' => $places,

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
            'place_id'=> $request->place_id,
            'description' => $request->description,

        ]);
       
        return redirect()->route('top');
        
    }


    public function show($post){
        $post = Post::find($post);
        $my_user = \Auth::user();
        $comments = Comment::where('post_id',$post->id )->oldest()->get();

        return view('posts.show',[
            'my_user' => $my_user,
            'title' =>'投稿詳細',
            'post' => $post,
            'comments' =>$comments,

        ]);
       
    }




    public function toggleLike($id){
        $my_user = \Auth::user();
        $post = Post::find($id);

        if($post->isLikedBy($my_user)){
            //いいねを取り消す
            $post->likes->where('user_id', $my_user->id)->first()->delete();
        } else
            //いいねを保存
            Like::create([
                'user_id' => $my_user->id,
                'post_id' => $post->id,
            ]);

        return redirect()->route('post.show',$id);
    }



    public function place_post_index($place){
        $my_user = \Auth::user();
        $posts = Post::where('place_id',$place)->latest()->get();
        $place = Place::find($place);

        return view('posts.place_post_index',[
            'my_user'=>$my_user,
            'posts' => $posts,
            'title' =>'都道府県別の投稿',
            'place'=> $place,
        ]);
    }

    public function destroy($post){
        $post = Post::find($post);
        
        $my_user = \Auth::user();


        if($post->image !== ''){
            \Storage::disk('public')->delete($post->image);
        }
       if($post->image2 !== ''){
            \Storage::disk('public')->delete($post->image2);
       }

       $post->delete();

       return redirect()->route('top');
    }



    public function post_edit($post){
        $post = Post::find($post);
        $my_user =\Auth::user();
        $places = Place::all();

        if($my_user->id === $post->user->id){
            return view('posts.edit',[
                'my_user' => $my_user,
                'post' =>$post,
                'places' =>$places,
                'title' => '投稿編集ページ'
            ]);
        }
        else{
            return view('errors.error',[
                'my_user' => $my_user,
                'title' =>'不正なアクションを検出しました',
            ]);
        }

    }


    public function post_update($post, PostUpdateRequest $request){
        $post = Post::find($post);
        $my_user = \Auth::user();

        if($post->user->id === $my_user->id){
            $post->update($request->only(['title','description','place_id']));

            return redirect()->route('post.show',$post->id);
        }
        else{
            return view('errors.error'.[
                'my_user'=> $my_user,
                'title' => '不正なアクションを検出しました',
            ]);
        }

    }

    public function post_image_edit($post){
        $post = Post::find($post);
        $my_user = \Auth::user();

        if($my_user->id === $post->user->id){
            return view('posts.edit_image',[
                'post' => $post,
                'my_user' => $my_user,
                'title' =>'画像編集ページ'
            ]);
        }else{
            return view('errors.error',[
                'my_user' => $my_user,
                'title' =>'不正なアクションを検出しました',
            ]);
        }
    }

    public function post_image_update($post, PostImageUpdateRequest $request){
        $my_user = \Auth::user();
        $post = Post::find($post);
        if($my_user->id === $post->user->id){
            
            $path = '';
            $path2 = '';

            $image = $request->file('image');
            $image2 =$request->file('image2');

            if(isset($image) ===true){
                $path = $image->store('postPhotos','public');
            }else{
                $path = $post->image;
            }        

            if(isset($image2) === true){
                $path2 = $image2->store('postPhotos','public');
            }else{
                $path2 = $post->image2;
            }

            if($post->image !== ''){
                \Storage::disk('public')->delete(\Storage::url($post->image));
            }

            if($post->image2 !== ''){
                \Storage::disk('public')->delete(\Storage::url($post->image2));
            }

            $post->update([
                'image' =>$path,
                'image2' => $path2,
            ]);

            return redirect()->route('post.show',$post->id);
        }else{
            return view('errors.error',[
                'my_user' =>$my_user,
                'title' =>'不正なアクションを検出しました',
            ]);
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
