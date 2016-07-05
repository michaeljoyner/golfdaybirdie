@extends('front.base')

@section('head')
    @include('front.partials.ogmetatags', [
        'ogImage' => asset('images/fb_image.png'),
        'ogTitle' => $category->name . ' | Golf Day Birdie',
        'ogDescription' =>  $category->description
    ])
@endsection

@section('content')
    <div class="w-section argyle-banner about">
        <h1 class="section-heading mission">{{ $category->name }}</h1>
    </div>
    <div class="w-section section-products category-product-list">
    @foreach($category->products->chunk(3) as $row)
        <div class="category-row">
            <div class="w-row column-row">
                @foreach($row as $product)
                    <div class="product-item">
                        <a href="/product/{{ $product->slug }}">
                            <img class="product-item-image" src="{{ $product->smallestImageSrc() }}" alt="{{ $product->name }}"/>
                            <h3 class="product-item-heading">{{ $product->name }}</h3>
                        </a>
                        <p class="product-item-description">{{ $product->description }}</p>
                        <a class="w-button add-button" href="/product/{{ $product->slug }}">VIEW PRODUCT</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    </div>
    <div class="w-section argyle-divider"></div>
@endsection