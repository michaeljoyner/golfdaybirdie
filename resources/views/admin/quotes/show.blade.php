@extends('admin.base')

@section('content')
    <header class="gbb-page-header">
        <h1>Quote Request from {{ $quoteRequest->name }}</h1>
        <div class="header-action">
            <div class="btn gbb-btn btn-blue">
                <a href="/admin/quoterequests/archive/{{ $quoteRequest->id }}">Archive</a>
            </div>
        </div>
        <hr/>
    </header>
    <div class="quote-request-body">
        <p><span class="label-text">Sent by: </span>{{ $quoteRequest->name }}</p>
        <p><span class="label-text">Email Address: </span>{{ $quoteRequest->email }}</p>
        <p><span class="label-text">Contact Number: </span>{{ $quoteRequest->phone }}</p>
        <p><span class="label-text">Delivery Address: </span>{{ $quoteRequest->address }}</p>
        <p><span class="label-text">Further Info: </span>{{ $quoteRequest->enquiry }}</p>

        <h3>Items Requested and Quantities</h3>
        @include('admin.quotes.partials.itemtable', ['quoteRequest' => $quoteRequest])
        <p><span class="label-text">Requested Packaging: </span>{{ $quoteRequest->packagingRequired() }}</p>
        <h3>Uploaded Logos and Images</h3>
        <div class="quote-request-logo-gallery">
            @if($quoteRequest->images->count() === 0)
                <p>No images were uploaded</p>
            @endif
            @foreach($quoteRequest->images as $image)
                <div class="logo-box">
                    <img src="{{ $image->smallestImageSrc() }}" alt=""/>

                    <div class="btn gbb-btn btn-blue">
                        <a href="{{ $image->originalImageSrc() }}" download>download</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection