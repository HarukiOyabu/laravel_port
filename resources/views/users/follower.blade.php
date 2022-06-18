@extends('layouts.logged_in')

@section('title', $title)

@section('content')


<article>
    <h2>followers</h2>

    @forelse($followers as $follower)
    <section class="follower">
        @if($follower->image !== '')
        <img src="{{ asset('storage/' . $follower->image) }}">
        @else
        <img src="{{ asset('images/no_image.png') }}">
        @endif

        <div class="follower_info">
            <div>
                <i>User_name</i>
                <p><a href="{{ route('user',$follower->id) }}">{{$follower->name}}</a></p>
            </div>
            @if($my_user->isFollowing($follower))
                <form method ="post" action="{{ route('follows.destory', $follower) }}" class="follow">
                    @csrf
                    @method('delete')
                    <input type="submit" value= "unFollow">
                </form>
            @else   
            <form method="post" action="{{ route('follows.store') }}" class="follow">
                    @csrf
                    <input type="hidden" name="follow_id" value="{{ $follower->id}}">
                    <input type="submit" value="Follow">
                </form>
             @endif   

        </div>
    </section>

    @empty
    <p>フォロワーはいません</p>
    @endforelse
</article>

@endsection