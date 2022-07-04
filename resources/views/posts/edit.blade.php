@extends('layouts.logged_in')

@section('title',$title)

@section('content')


<article>
    <form method="POST" action="{{route('post.update',$post->id) }}">
        @csrf
        @method('patch')
        <div>
            <label>Post-Title</br>
            <input type="text" name="title" value="{{$post->title}}">
        </div>
        <div>
            <label>Post-Description</br>
            <input type="text" name="description" value="{{$post->description}}">
        </div>
        <div>
            <label>Post-Place</br>
            <select name="place_id" value="$post->place->name">
                @forelse($places as $place)
                <option value="{{$place->id}}" {{$place->id === $post->place_id ? "selected" : ""}}>{{$place->name}}</option>
                @empty
                @endforelse
            </select>
        </div>

        <input type="submit" value="Update!">
    </form>
</article>

@endsection