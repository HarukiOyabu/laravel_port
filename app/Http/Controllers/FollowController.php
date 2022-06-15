<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;

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
        
        return redirect()->route('user',$my_user->id);
    }
 
    // フォロー削除処理
    public function destroy($id)
    {
        $my_user = \Auth::user();
        $follow = \Auth::user()->follows->where('follow_id', $id)->first();
        $follow->delete();
        
        return redirect()->route('user', $my_user->id);
    }
}
