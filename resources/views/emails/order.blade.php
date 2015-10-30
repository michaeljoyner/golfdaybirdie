<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Order Received from GolfDayBirdie</h2>
    <hr/>
    <p>Customer: {{ $order->customer_name }}</p>
    <p>Email: {{ $order->customer_email }}</p>
    <p>Contact No: {{ $order->customer_phone }}</p>
    <p>Delivery address: {{ $order->customer_address }}</p>
    <hr/>
    <p>Additional info: {{ $order->order_query }}</p>
    <hr/>
    <h3>Ordered Items</h3>
    <table>
        <thead>
            <tr>
                <td>Item</td>
                <td>Size</td>
                <td>Qty</td>
            </tr>
        </thead>
        <tbody>
        @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->fullItemName() }}</td>
                <td>{{ $item->getSizeText() }}</td>
                <td>{{ $item->quantity }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($order->orderImages->count() > 1)
        <p>Images were uploaded. <a href="http://golfdaybirdie.co.za/admin/orders/{{ $order->id }}">View Order</a></p>
    @endif
</body>
</html>