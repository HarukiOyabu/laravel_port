@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<section class="post_show">
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
                <i>User</i>
                @if($post->user->id !== $my_user->id)
                <p><a href="{{ route('user',$post->user->id) }}">{{$post->user->name}}</a></p>
                @else
                <p>{{$post->user->name}}</p>
                @endif
            </div>
            <p>{{$post->description}}</p>
            
        </div>
    </div>
    <div class="post_img">
        <img src="{{ asset('storage/' . $post->image) }}">
        <img src="{{ asset('storage/' . $post->image2) }}">
        
    </div>

<section>

@endsection