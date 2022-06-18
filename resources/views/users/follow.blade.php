@extends('layouts.logged_in')

@section('title', $title)

@section('content')

<article>
    <h2>follow_users</h2>

    @forelse($follow_users as $follow_user)
        
        <section class="follow_user">
            @if($follow_user->image !== '')
            <img src="{{ asset('storage/' . $follow_user->image) }}">
            @else
            <img src="{{ asset('images/no_image.png') }}">
            @endif

            <div class="follow_user_info">
                <div>
                    <i>User_name</i>
                    <p><a href="{{ route('user', $follow_user->id) }}">{{$follow_user->name}}</a></p>
                </div>
                <div>
                    @if($my_user->isFollowing($follow_user))
                    <form method ="post" action="{{ route('follows.destory', $follow_user) }}" class="follow">
                    @csrf
                    @method('delete')
                    <input type="submit" value= "unFollow">
                    </form>
                    @else   
                    <form method="post" action="{{ route('follows.store') }}" class="follow">
                    @csrf
                        <input type="hidden" name="follow_id" value="{{ $follow_user->id}}">
                        <input type="submit" value="Follow">
                    </form>
                    @endif   
                </div>
            </div>
        </section>
    @empty
        <p>フォローしているユーザーはいません</p>
    @endforelse



</article>


@endsection