@extends('front.base')

@section('content')
    <div class="w-section section hero-section">
        <div class="w-container hero-container"><img class="hero-logo" width="877" src="images/logo4.png">
            <div class="slide-text">For all your golf day branding NEEDS</div>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section section-slider">
        <h1 class="section-heading">TOP&nbsp;SELLERS</h1>
        <div class="slider-div">
            <div class="w-slider slider" data-animation="slide" data-duration="500" data-infinite="1">
                <div class="w-slider-mask slider-mask">
                    @foreach($products->chunk(9)->first() as $product)
                        <div class="w-slide slide"><img class="slide-image" src="{{ $product->smallestImageSrc() }}" alt="product image"/>
                            <h3 class="slide-heading">{{ $product->name }}</h3>
                            <div class="slide-description">{{ $product->description }}</div>
                            <a class="w-button add-button" href="/product/{{ $product->slug }}">CHECK IT OUT</a>
                        </div>
                    @endforeach
                </div>
                <div class="w-slider-arrow-left slider-left-arrow">
                    <div class="w-icon-slider-left slider-arrow"></div>
                </div>
                <div class="w-slider-arrow-right slider-right-arrow">
                    <div class="w-icon-slider-right slider-arrow"></div>
                </div>
                <div class="w-slider-nav w-slider-nav-invert w-round"></div>
            </div>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section section-products">
        <h1 class="section-heading">CATEGORIES</h1>
        @foreach($categories->chunk(3) as $row)
            <div class="category-row">
                <div class="w-row column-row">
                    @foreach($row as $category)
                        <a href="/category/{{ $category->slug }}"><div class="w-col w-col-4">
                                <div class="category-wrapper"><img class="category-image" src="{{ $category->smallestImageSrc() }}">
                                    <h1 class="category-heading">{{ $category->name }}</h1>
                                </div>
                            </div></a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section section-events">
        <h1 class="section-heading">UPCOMING&nbsp;EVENTS</h1>
        <div class="events-wrapper"></div>
    </div>
    <div class="w-section argyle-divider"></div>
@endsection