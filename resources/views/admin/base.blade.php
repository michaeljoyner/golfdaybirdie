<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @section('title')
    <title>Golfballbranding</title>
    @show
    @yield('head')
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
</head>
<body>
    @include('admin.partials.navbar')
    <div class="container">
        @yield('content')
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/all.js') }}"></script>
    @yield('bodyscripts')
</body>
</html>