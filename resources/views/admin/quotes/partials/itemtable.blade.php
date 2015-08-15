<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Item</td>
            <td>Qty</td>
        </tr>
    </thead>
    <tbody>
    @foreach($quoteRequest->products as $index => $product)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->quantity }}</td>
        </tr>
    @endforeach
    </tbody>
</table>