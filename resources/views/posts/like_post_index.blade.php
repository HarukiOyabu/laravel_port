@extends('layouts.logged_in')

@section('title',$title)

@section('content')
<h2>{{$place->name}}のお気に入りの投稿</h2>

<article>
 @forelse($posts as $post)

    <section class="post">

       <img src="{{ asset('storage/' . $post->image) }}">
        <div class="post_description">
            <div class="post_item">
                <i>Post_Title</i>
                <h2> <a href="{{ route('post.show',$post)}}">{{$post->title}}</a></h2>
            </div>

            <div class="post_item">
                 <i>Post_user</i>
                 <h2><a href="{{ route('user',$post->user_id) }}">{{$post->user->name}}</a></h2>
            </div>
             

        </div>
            
             
    </section>
    @empty
    <p>投稿はありません</p>
    @endforelse



</article>



@endsection