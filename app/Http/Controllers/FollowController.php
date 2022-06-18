<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    // フォロー追加処理
    public function store(Request $request)
    {
        $my_user = \Auth::user();
        Follow::create([
           'user_id' => $my_user->id,
           'follow_id' => $request->follow_id,
        ]);
        
        return redirect()->route('follows.index',$my_user->id);
    }
 
    // フォロー削除処理
    public function destroy($id)
    {
        $my_user = \Auth::user();
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        
        return redirect()->route('follows.index', $my_user->id);
    }


    //フォローユーザー一覧
    public function index(){
        $my_user = \Auth::user();
        $follow_users = \Auth::user()->follow_users;

        return view('users.follow',[
            'title' => 'follow_users',
            'my_user' => $my_user,
            'follow_users' => $follow_users,

        ]);
    }

    //フォロワー一覧
    public function followers_index(){
        $my_user = \Auth::user();
        $followers = \Auth::user()->followers;

        return view('users.follower',[
            'title' => 'followers',
            'my_user' => $my_user,
            'followers' => $followers,
            
        ]);
    }
}
