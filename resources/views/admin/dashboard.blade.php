@extends('admin.base')

@section('content')
    <h1 class="dash-page-heading">Hey, {{ Auth::user()->name }}. How's it going?</h1>
    <hr/>
    <div class="left-side pull-left">
        <div class="promo-section">
            <h2 class="dash-section-heading">Your Promoted Products</h2>
            @include('admin.partials.popularproducts', ['popularProducts' => $promoted, 'emptyMessage' => 'You haven\'t promoted any products'])
        </div>
        <div class="popular-section">
            <h2 class="dash-section-heading">Your Most Popular Products</h2>
            @include('admin.partials.popularproducts', ['popularProducts' => $popular, 'emptyMessage' => 'There are no orders yet.'])
        </div>
    </div>
    <div class="right-side pull-right stats-block">
        <div class="stat-card">
            <span class="stat-num">{{ $ordersInLastWeek }}</span>
            <span class="stat-name">Orders in the last week</span>
        </div>
        <div class="stat-card">
            <span class="stat-num">{{ $totalCategories }}</span>
            <span class="stat-name"> categories in total</span>
        </div>
        <div class="stat-card">
            <span class="stat-num">{{ $totalProducts }}</span>
            <span class="stat-name">Products in total</span>
        </div>
    </div>
@endsection