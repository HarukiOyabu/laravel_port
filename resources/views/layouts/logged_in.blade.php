@extends('layouts.default')
@section('header')
<header>
    <h1><a href="{{route('top')}}">{{$title}}</a></h1>
    <nav>
        <ul>
               <li><a href="{{route('user',$my_user->id)}}">PROFILE</a></li>
               <li><a href="{{route('post.auth')}}">MY_POST</a></li>
               <li><a href="">Follow</a></li> 
               <li><a href="{{ route('post.create')}}" >New Post</a></li>
        </ul>
    </nav>
</header>

@endsection

@section('footer')
<footer class="footer">
    <div>
        <small>Copyright&copy Example</small>
    </div>
</footer>
@endsection