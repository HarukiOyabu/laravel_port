<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    
    <title>@yield('title')</title>
    <link rel ="stylesheet" href="{{asset('css/styles.css?20220527')}}">
</head>
<body>
    
@yield('header')



@yield('content')


@yield('footer')
</body>