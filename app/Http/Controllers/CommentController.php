<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    //コメント追加
    public function store(CommentRequest $request){
        $my_user = \Auth::user();

        Comment::create([
            'post_id' =>$request->post_id,
            'user_id' =>$my_user->id,
            'text' =>$request->text,
        ]);

        return redirect()->route('post.show', $request->post_id);
    }
}
