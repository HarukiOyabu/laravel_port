@extends('layouts.logged_in')

@section('title',$title)

@section('content')

<article class="edit_image">
    <p>現在の画像</p>
    <form method="POST" action="{{route('post_image.update',$post) }}" enctype="multipart/form-data">
    @csrf
    @method('patch')
        <section>
            <div>
                <img src="{{ asset('storage/'. $post->image)}}">
                <input type="file" name="image">
            </div>
            
            <div>
                 <img src="{{asset('storage/'. $post->image2)}}">
                <input type="file" name="image2" >
            </div>
           
        </section>

        <input type="submit" value="Update">
    </form>
</article>
@endsection