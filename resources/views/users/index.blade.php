@extends('layouts.logged_in')


@section('title',$title)

@section('content')


<section class="user">
    <h2>ユーザー情報</h2>

    <div class="user_info">
        @if($user->image !== '')
        
        <img loading='lazy' src="{{ asset('storage/' . $user->image) }}">
        
        @else
        <img loading='lazy' src="{{ asset('images/no_image.png') }}">
       
        @endif

        <section class="user_text">

            <div>
                <i>user_name</i>
                <h2>{{$user->name}}</a></h2>
            </div>
            <div>
                <i>user_profile</i>
                @if($user->profile !== '')
                <p>{{$user->profile}}

                @else
                <p>このユーザーはまだ設定してません</p>

                @endif
            </div>
            <div class = "follow_count">
                <div>
                    <i>follow_user</i>
                    <p>{{$follow_users->count()}}</p>
                </div>
                <div>
                    <i>follower</i>
                    <p>{{$followers->count()}}</p>
                </div>
            </div>
         </section>
    </div>


    <div class="update">
        @if($my_user->id === $user->id)
        <a href="{{ route('user_edit_image') }}">Up Date img</a>

        <form action="{{route('logout')}}" method="POST">
        @csrf
        <input type="submit" value="Logout">
        </form>
        <a href="{{ route('user_edit') }}">Up Date Profile</a>

        @else

            @if($my_user->isFollowing($user))
                <form method ="post" action="{{ route('follows.destory', $user) }}" class="follow">
                    @csrf
                    @method('delete')
                    <input type="submit" value= "unFollow">
                </form>
            @else   
            <form method="post" action="{{ route('follows.store') }}" class="follow">
                    @csrf
                    <input type="hidden" name="follow_id" value="{{ $user->id}}">
                    <input type="submit" value="Follow">
                </form>
             @endif   
        @endif
    </div>
</section>


@endsection
