@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<article class="post_show">
    <div class="post_show_item">

        <div class="post_user">
            @if($post->user->image !== '')
                <img src="{{ asset('storage/' . $post->user->image) }}">
            @else
                <img src="{{asset('images/no_image.png')}}">
            @endif
        </div>

        <div class="post_content">
            <div>
                <i>Post-Title</i>
                <h2>{{$post->title}}</h2>
            </div>
            <div>
                <i>User_Name</i>
                @if($post->user->id !== $my_user->id)
                <p><a href="{{ route('user',$post->user->id) }}">{{$post->user->name}}</a></p>
                @else
                <p>{{$post->user->name}}</p>
                @endif
            </div>
            
            <div>
                <p>{{$post->place->name}}</p>
                <p>{{$post->description}}</p>
            </div>
            
            <div>
                @if($post->isLikedBy(Auth::user()))
                <a class= "like_button good">❤︎</a>
                @else
                <a class="like_button un_good">♡</a>
                @endif

                <form method="post" class="" action="{{ route('posts.toggle_like', $post) }}">
                @csrf
                @method('patch')
                </form>
            </div>
        

        </div>
    </div>
    <div class="auth_command">
        @if($post->user->id === $my_user->id)
        <a href="{{ route('post.edit',$post) }}">投稿を編集</a>
        <form method="post" action="{{ route('post.destroy', $post->id) }}">
        @csrf
        @method('DELETE')
        <input type="submit" value="投稿を削除">
        </form>
        <a href="{{ route('post_image.edit',$post)}}">投稿写真を編集</a>
        @else
        @endif
    </div>

    <div class="post_img">
        <img src="{{ asset('storage/' . $post->image) }}">
        <img src="{{ asset('storage/' . $post->image2) }}">
        
    </div>

    <form method='post' action="{{ route('comment.store') }}" class="comment_form">
        @csrf
        <input type="hidden" name="post_id" value="{{$post->id }}">
        <input type="text" name="text" placeholder="add Comment" class="comment_text">
        <input type="submit" value="Comment!">
    </form>
    <div class="comments">
        @forelse($comments as $comment)
        <div class="comment">
            <div>
                @if($comment->user->image !== '')
                <img src="{{ asset('storage/' . $comment->user->image)}}" class="comment_user_img">
                @else
                <img src="{{ asset('images/no_image.png')}}" class="comment_user_img">
                @endif
                <div>
                    <p><a href="{{ route('user', $comment->user->id)}}">User_name: {{$comment->user->name}}
                        @if($post->user->id === $comment->user->id)
                        (投稿主)
                        @else
                        @endforelse
                        </a>
                    </p>
                
                     <p>Comment_Date::{{$comment->created_at}}
                </div>
            </div>
            <div>
            <p>{{$comment->text}}</p>
            </div>
        </div>
        @empty
        </p>まだコメントはありません</p>
        @endforelse
    </div>
</article>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  /* global $ */
  $('.like_button').on('click', (event) => {
      $(event.currentTarget).next().submit();
  })
</script>
@endsection


