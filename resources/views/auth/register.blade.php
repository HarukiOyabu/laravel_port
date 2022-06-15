@extends('layouts.not_logged_in')


@section('content')

<section class="register">
<div class="register_main">
<form method="POST" action="{{route('register')}}" class="register_form">
    @csrf
    <h1>Sign Up</h1>
    <div class="register_content">
        <label><input type="text" name="name" placeholder="UserName"></label>
        <label><input type="email" name="email" placeholder="mailaddress"></label>
        <label><input type="password" name="password" placeholder="password"></label>
        <label><input type="password" name="password_confirmation" placeholder="password_confirmation"></label>
    </div>
    <input type="submit" value="register">

    <p><a href="{{ route('login')}}">ログイン画面へ</a></p>
</form>


</div>
<footer class="register_footer">
    <div>
        <small>Copyright&copy Example</small>
    </div>
</footer>
</section>


@endsection