@extends('layouts.logged_in')


@section('title', $title)

@section('content')

<main class="user_img_edit">
    <div class="edit_image">
     <h2>現在の画像</h2>
        @if($my_user-> image  !== '')
        <img src="{{ asset('storage/' . $my_user->image) }}">

        @else
        <img src="{{ asset('images/no_image.png')}}">

        @endif
    </div>


    <form method="POST" action="{{ route('profile.update_image')}}" enctype="multipart/form-data">
    @csrf
    @method('patch')

     <div>
         <label>画像を選択<br>
            <input type="file" name="image">
        </label>
    </div>

      <input type="submit" value="UpDate" class="submit">

        @foreach($errors->all() as $error)
        <p class="error_message">{{$error}}</p>
        @endforeach 
    </form>
</main>


@endsection