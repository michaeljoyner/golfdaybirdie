@extends('admin.base')

@section('content')
    <h1>Hey, {{ Auth::user()->name }}. How's it going?</h1>
    <div class="promo-section">
        <h2>Your Promoted Products</h2>
        @include('admin.partials.popularproducts', ['popularProducts' => $promoted, 'emptyMessage' => 'You haven\'t promoted any products'])
    </div>
    <div class="popular-section">
        <h2>Your Most Popular Products</h2>
        @include('admin.partials.popularproducts', ['popularProducts' => $popular, 'emptyMessage' => 'There are no orders yet.'])
    </div>
@endsection