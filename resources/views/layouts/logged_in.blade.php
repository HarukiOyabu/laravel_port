@extends('layouts.default')
@section('header')
<header>
    <section>
        <h1><a href="{{route('top')}}">{{$title}}</a></h1>
        <nav>
            <ul>
                <li><a href="{{route('top') }}">HOME</a></li>
                <li><a href="{{route('user',$my_user->id)}}">PROFILE</a></li>
                <li><a href="{{ route('follows.index') }}">Follow_User</a></li> 
                <li><a href="{{ route('followers.index') }}">Follower</a></li>
                <li><a href="{{ route('like.menu')}}">Like_list</a></li>
                <li><a href="{{ route('post.create')}}" >New Post</a></li>
            </ul>
         </nav>
    </section>
   
</header>

@endsection

@section('footer')
<footer class="footer">
    <div>
        <small>Copyright&copy Example</small>
    </div>
</footer>
@endsection