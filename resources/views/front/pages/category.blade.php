@extends('front.base')

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
                        <img class="product-item-image" src="{{ $product->smallestImageSrc() }}" alt="product image"/>
                        <h3 class="product-item-heading">{{ $product->name }}</h3>
                        <p class="product-item-description">{{ $product->description }}</p>
                        <a class="w-button add-button" href="/product/{{ $product->slug }}">CHECK IT OUT</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
    </div>
    <div class="w-section argyle-divider"></div>
@endsection