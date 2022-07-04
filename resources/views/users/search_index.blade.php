@extends('layouts.logged_in')


@section('title',$title)

@section('content')
<h2>検索結果</h2>

<article class="user_search_result">
    @forelse($users as $user)
    <section>
        <div class="img_area">
            @if($user->image !== '')
            <img src="{{ asset('storage/'. $user->image)}}">
            @else
            <img src="{{ asset('images/no_image.png')}}">
            @endif
        </div>

        <div>
            <i>User_name</i>
            <p><a href="{{route('user',$user->id) }}">{{$user->name}}</a></p>
        </div>

    </section>
    @empty
    <p> 該当するユーザーはいません</p>
    @endforelse
</article>
@endsection