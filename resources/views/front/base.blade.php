<!DOCTYPE html>
@section('htmltag')
<html data-wf-site="55bacdc9bb74ff2b476ec9a9" data-wf-page="55bacdc9bb74ff2b476ec9aa">
@show
<head>
    <meta charset="utf-8">
    <title>Golf Ball Branding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('head')
    <link rel="stylesheet" href="{{ elixir('css/fapp.css') }}"/>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
            }
        });
    </script>
    <script type="text/javascript" src="js/modernizr.js"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <meta name="description" content="Get your logo printed onto top of the range balls. We also do branded packaging."/>
    @include('front.partials.ogmetatags')
</head>
<body>
@yield('content')
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/webflow.js"></script>
<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
<script src="{{ asset('js/all.js') }}"></script>
@yield('bodyscripts')
</body>
</html>