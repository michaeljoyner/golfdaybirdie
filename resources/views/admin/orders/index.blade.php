@extends('admin.base')

@section('content')
    <div class="gbb-page-header">
        @if(! $isArchives)
            <h1>Orders</h1>
        @else
            <h1>Archived Orders</h1>
        @endif
        <div class="header-action">
            @if(! $isArchives)
                <div class="btn gbb-btn btn-blue">
                    <a href="/admin/orders/archives">Archives</a>
                </div>
            @else
                <div class="btn gbb-btn">
                    <a href="/admin/orders">Current</a>
                </div>
            @endif
        </div>
        <hr/>
    </div>
    <div class="orders-list-section">
        @foreach($orders as $order)
            <div class="order-summary">
                <header class="clearfix">
                    <a href="/admin/orders/{{ $order->id }}">
                        <h2 class="order-customer-name">{{ $order->customer_name }}</h2>
                    </a>
                    <div class="order-date">
                        {{ $order->created_at->diffForHumans() }}
                    </div>
                </header>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Product name</td>
                            <td>Size</td>
                            <td>Quantity</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderItems as $index => $item)
                        <tr>
                            <td>{{ $index + 1}}</td>
                            <td>{{ $item->fullItemName() }}</td>
                            <td>{{ $item->getSizeText() }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endforeach
        @if($orders->count() < 1)
            <h3>There are no orders to show</h3>
        @endif
    </div>
@endsection

@section('bodyscripts')
    @include('admin.partials.flash')
@endsection