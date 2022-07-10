@extends('layouts.logged_in')


@section('title',$title)

@section('content')

<form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data" class="create_post">
@csrf
    <div>
        <label>Title<br>
            <input type="text" name="title" class="create_title">
        </label>
    </div>

    <div>
        <label>Description<br>
            <input type="text" name="description" class="create_description">
        </label>
    </div>

    <div>
        <input type="file" name="image">
        <input type="file" name="image2">

    </div>

    

    <div>
        <label>Place<br>
        <select name ="place_id">
            @forelse($places as $place)
                <option value="{{$place->id}}" name="place_id">{{$place->name}}</option>
            @empty
                <p>選択肢はありません</p>
            @endforelse
        </select>
    </div>

    <input type="submit" value="Post!">
    
    @foreach($errors->all() as $error)
    <p class="error_message">{{$error}}</p>
    @endforeach 
</form>


@endsection