<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golf Day Birdie</title>
    <style>
        body {
            width: 100%;
            height:100%;
        }

        .container {
            width: 400px;
            max-width: 96%;
            margin: 0 auto;
            padding-top: 20vh;
        }

        .logo-img {
            width: 100%;
            margin-bottom: 20px;
        }

        form input[type=email], form input[type=password] {
            width: 100%;
            height: 32px;
            padding-left: 5px;
            margin: 8px 0;
        }

        label {
            font-size: small;
            text-transform: uppercase;
            font-family: Helvetica, Ariel, sans-serif;
            color: #7ECBBB;
        }

        button.sub {
            width: 100%;
            height: 32px;
            background: #7ECBBB;
            color: white;
            padding-left: 5px;
            border: none;
            text-transform: uppercase;
        }

        button.sub:hover {
            background: #184f5e;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="/images/logo4.png" alt="Golf day birdie logo" class="logo-img">
        @include('errors')
        @include('admin.forms.login')
    </div>
</body>
</html>
