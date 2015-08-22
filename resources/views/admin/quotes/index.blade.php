@extends('admin.base')

@section('content')
    <h1>
        @if(! $isArchives)
            Quote Requests
        @else
            Archived Quote Requests
        @endif
    </h1>
    @if($quoteRequests->count() === 0)
        <p>There are no @if(!$isArchives) current @else archived @endif quote requests.</p>
    @endif
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

@section('bodyscripts')
    @include('admin.partials.flash')
@endsection