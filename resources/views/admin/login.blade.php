<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golfballbranding</title>
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

        form input[type=email], form input[type=password] {
            width: 100%;
            height: 32px;
            padding-left: 5px;
        }

        label {
            font-size: small;
            text-transform: uppercase;
            font-family: Helvetica, Ariel, sans-serif;
        }

        button {
            width: 100%;
            height: 32px;
            background: orangered;
            color: white;
            padding-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>GolfBallBranding</h1>
        @include('errors')
        @include('admin.forms.login')
    </div>
</body>
</html>
