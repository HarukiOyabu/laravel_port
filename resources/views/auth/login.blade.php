@extends('layouts.not_logged_in')

@section('content')

<section class="login">
<div class="login_main" >
    <form method="POST" action="{{route('login')}}" class="login_form">
         @csrf
        <h1>Login Form</h1>
        <div class="login_content">
          <label><input type="email" name="email" placeholder="mailaddress"></label>
          <label><input type="password" name="password" placeholder="password"></label>
        </div>
        
        <input type="submit" value="login">

        <p><a href="{{ route('register')}}">登録画面へ移動</a></p>
    </form>

   
</div>
<footer class="login_footer">
    <div>
        <small>Copyright&copy Example</small>
    </div>
</footer>
</section>
@endsection