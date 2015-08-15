@extends('admin.base')

@section('content')
    <h1>Quote Requests</h1>
    @foreach($quoteRequests as $quoteRequest)
        <div class="quote-request-box">
            <header>
                <a href="/admin/quoterequests/{{ $quoteRequest->id }}"><p class="qr-name">{{ $quoteRequest->name }}</p></a>
                <p class="qr-time pull-right">{{ $quoteRequest->created_at->diffForHumans() }}</p>
            </header>
            @include('admin.quotes.partials.itemtable', ['quoteRequest' => $quoteRequest])
        </div>
    @endforeach
    <div class="pagination">
        {!! $quoteRequests->render() !!}
    </div>
@endsection