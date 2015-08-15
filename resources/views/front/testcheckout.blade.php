<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <h1>Your Cart</h1>
    <hr/>
    @if($contents->count() === 0)
        <p>Your cart is empty</p>
    @else
        <ul>
        @foreach($contents as $item)
            <li>{{ $item->name }}</li>
        @endforeach
        </ul>
        <a href="/cart/destroy">Empty Cart</a>
    @endif
</body>
</html>