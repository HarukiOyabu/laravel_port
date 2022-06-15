@extends('layouts.logged_in')


@section('title',$title)

@section('content')


<form method="POST" action="{{route('profile.update')}}">
@csrf
@method('patch')
    <div>
        <label>name<br>
        <input type="text" name = "name" value="{{$my_user->name}}">
        </label>
    </div>

    <div>
        <label>profile<br>
        <input type="text" name = "profile" value="{{$my_user->profile}}" class="input_profile">
        </label>
    </div>


    <input type="submit" value="UpDate">
</form>



@endsection