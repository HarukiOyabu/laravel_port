@extends('layouts.logged_in')


@section('title',$title)

@section('content')

<main class="user_edit">
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

        @foreach($errors->all() as $error)
        <p class="error_message">{{$error}}</p>
        @endforeach 

        <input type="submit" value="UpDate" class="submit">
    </form>
</main>


@endsection