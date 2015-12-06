@extends('admin.base')

@section('content')
    <div class="gbb-page-header">
        <h1 class="product-show-title">Order from {{ $order->customer_name }}</h1>
        <div class="header-action">
            <div class="btn gbb-btn btn-blue">
                <a href="/admin/orders/archives/{{ $order->id }}">@if($order->is_archived) Unarchive @else Archive @endif</a>
            </div>
            @include('admin.partials.deletebutton', [
                'objectName' => 'order from '.$order->customer_name,
                'deleteFormAction' => '/admin/orders/'.$order->id
            ])
        </div>
        <hr/>
        <section class="order-details">
            <p><span class="detail-label">Order date: </span>{{ $order->created_at->toFormattedDateString() }}</p>
            <p><span class="detail-label">Customer: </span>{{ $order->customer_name }}</p>
            <p><span class="detail-label">Contact no: </span>{{ $order->customer_phone }}</p>
            <p><span class="detail-label">Email: </span>{{ $order->customer_email }}</p>
            <p><span class="detail-label">Delivery address: </span>{{ $order->customer_address }}</p>
            <p class="detail-label">Additional Info</p>
            @if($order->order_query !== "")
                <p>{{ $order->order_query }}</p>
            @else
                <p>None given</p>
            @endif
        </section>
        {{--<section class="order-show-items">--}}
            {{--<h2 class="items-title">Requested Items</h2>--}}
            {{--<table class="table">--}}
                {{--<tbody>--}}
                    {{--@foreach($order->orderItems as $item)--}}
                        {{--<tr>--}}
                            {{--<td><img src="{{ $item->itemThumb() }}" alt="item thumbnail" class="item-thumb"/></td>--}}
                            {{--<td class="item-name">{{ $item->fullItemName() }}</td>--}}
                            {{--<td>{{ $item->getSizeText() }}</td>--}}
                            {{--<td>{{ $item->quantity }}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</section>--}}
        <section class="uploads-section">
            <h2>Images Uploaded</h2>
            @foreach($order->orderImages as $image)
                <div class="order-image-box">
                    <img src="{{ $image->smallestImageSrc() }}" alt=""/>
                    <a href="{{ $image->originalImageSrc() }}" download>
                        <div class="btn gbb-btn btn-blue">Download</div>
                    </a>
                </div>
            @endforeach
        </section>
    </div>

    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    @include('admin.partials.flash')
@endsection