<!DOCTYPE html>
<html data-wf-site="56146b80b859b94255996a4b" data-wf-page="56146b80b859b94255996a4c">
<head>
    <meta charset="utf-8">
    <title>Golf Day Birdie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ elixir('css/fapp.css') }}"/>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="Golf Day Birdie">
    <meta name="application-name" content="Golf Day Birdie">
    <meta name="theme-color" content="#184f5e">
    @yield('head')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Open Sans:300,400,500,600,700","Bitter:400,700,400italic","Exo:300"]
            }
        });
    </script>
    <script type="text/javascript" src="/js/modernizr.js"></script>
</head>
<body>
@include('front.partials.navbar')
@yield('content')
@include('front.partials.footer')
<script src="{{ elixir('js/fall.js') }}"></script>
<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
@yield('bodyscripts')
        <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
<script>
    window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
    ga('create','UA-51468211-7','auto');ga('send','pageview')
</script>
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
</body>
</html>