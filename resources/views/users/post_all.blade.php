@extends('layouts.logged_in')


@section('title',$title)

@section('content')


<section class="user_post">


@forelse($posts as $post)

<div class="post">

    <img src="{{ asset('storage/' . $post->image) }}">
    <div class="post_description">
    <div class="post_item">
        <i>Post_Title</i>
        <h2> <a href="{{ route('post.show',$post)}}">{{$post->title}}</a></h2>
    </div>

    <div class="post_item">
         <i>Post_Place</i>
         <p>{{$post->place->name}}</p>
    </div>
 

</div>

 
</div>
@empty
<p>投稿はありません</p>
@endforelse

</section>


@endsection