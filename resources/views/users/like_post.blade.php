@extends('layouts.logged_in')


@section('title',$title)

@section('content')

<h2>都道府県から探す</h2>
<ul class="places">
        
        @forelse($places as $place)
        <li><a href="{{ route('like.post.index', $place->id) }}" class="place">{{$place->name}}</a></li>
        @empty
        @endforelse
</ul>
<article>
    
    @forelse($like_posts as $like_post)
    <section class="post">

        <img src="{{ asset('storage/' . $like_post->image) }}">
        <div class="post_description">

            <div class="post_item">
                <i>Post_Title</i>
                <h2><a href="{{ route('post.show', $like_post) }}">{{$like_post->title}}</a></h2>
            </div>
            <div class="post_item">
                <i>Post_Place</i>
                <p>{{ $like_post->place->name}}</p>
            </div>
            <div class="post_item">
                <i>Post_User</i>
                <h2><a href="{{ route('user', $like_post->user_id) }}">{{$like_post->user->name}}</a></h2>
            </div>
    </section>
    @empty
    <p>お気に入りの投稿はありません</p>
    @endforelse
</article>

@endsection