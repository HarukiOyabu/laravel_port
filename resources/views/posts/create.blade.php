@extends('layouts.logged_in')


@section('title',$title)

@section('content')

<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
@csrf
    <div>
        <label>Title<br>
            <input type="text" name="title">
        </label>
    </div>

    <div>
        <label>Description<br>
            <textarea name="description"></textarea>
        </label>
    </div>

    <div>
        <input type="file" name="image">

    </div>

    <div>
        <input type="file" name="image2">
    </div>

    <input type="submit" value="Post!">
</form>


@endsection