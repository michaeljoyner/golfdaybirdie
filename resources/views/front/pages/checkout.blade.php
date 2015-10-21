@extends('front.base')

@section('content')
    <div class="w-section argyle-banner about">
        <h1 class="section-heading mission">CHECKOUT</h1>
    </div>
    <div class="w-section checkout-form-section">
        <form class="gdb-form" action="/checkout" method="POST">
            {!! csrf_field() !!}
            <div class="gdb-form-group">
                <label for="customer_name">Your Name: </label>
                <input type="text" name="customer_name" required value="{{ old('customer_name') }}"/>
            </div>
            <div class="gdb-form-group">
                <label for="customer_phone">Your Contact No: </label>
                <input type="text" name="customer_phone" required value="{{ old('customer_phone') }}"/>
            </div>
            <div class="gdb-form-group">
                <label for="customer_email">Your Email: </label>
                <input type="email" name="customer_email" required value="{{ old('customer_email') }}"/>
            </div>
            <div class="gdb-form-group">
                <label for="customer_address">Your Address (for delivery): </label>
                <textarea name="customer_address" required>{{ old('customer_address') }}</textarea>
            </div>
            <div class="gdb-form-group">
                <label for="customer_address">Additional Info: </label>
                <textarea
                        name="order_query"
                        placeholder="If you have any further queries or instructions, please let us know here"
                        required
                >
                    {{ old('order_query') }}
                </textarea>
            </div>
            <div class="gdb-form-group">
                <button type="submit">Place Order</button>
            </div>
        </form>
    </div>
@endsection