@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<article>
<h2>都道府県別の投稿</h2>
    <ul class="places">
        
        @forelse($places as $place)
        <li><a href="{{ route('place.posts', $place->id) }}" class="place">{{$place->name}}</a></li>
        @empty
        @endforelse
    </ul>

    <div class="user_search">
        <p>ユーザーを検索</p>
        <form  method="POST"  action="{{route('user.search')}}">
         @csrf
        
         <input type="text" name="keyword" placeholder="user-nameを入力">
         <input type="submit" value="search">
        </form>
    </div>

<h2>最新の投稿</h2>
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