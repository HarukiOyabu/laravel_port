<?php

namespace App\Http\Controllers;

Use App\User;
use App\Post;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;


class UserController extends Controller
{
    public function index($user_id){

        $my_user = \Auth::user();

        $user = User::find($user_id);

        return view('users.index', [
            'title'=> 'ユーザー画面',
            'my_user'=> $my_user,
            'user'=> $user,
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


    public function __construct()
    {
        $this->middleware('auth');
    }

}
