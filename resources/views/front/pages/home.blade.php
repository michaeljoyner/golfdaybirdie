@extends('front.base')

@section('head')
    @include('front.partials.ogmetatags', [
        'ogImage' => asset('images/fb_image.png'),
        'ogTitle' => 'Golf Day Birdie',
        'ogDescription' => 'Golf Day Birdie is your best solution to all your golf day needs. We provide the best quality clothing, golfing accessories and gift items, and we are always open to custom requests.'
    ])
@endsection

@section('content')
    <div class="w-section section hero-section">
        <div class="w-container hero-container"><img class="hero-logo" width="877" src="images/logo_shadow.png">
            <div class="slide-text">For all your golf day branding NEEDS</div>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section section-slider">
        <h1 class="section-heading">TOP SELLERS</h1>
        <div class="slider-div">
            <div class="w-slider slider" data-animation="slide" data-duration="500" data-infinite="1">
                <div class="w-slider-mask slider-mask">
                    @foreach($products as $product)
                        <div class="w-slide slide"><img class="slide-image" src="{{ $product->smallestImageSrc() }}" alt="product image"/>
                            <h3 class="slide-heading">{{ $product->name }}</h3>
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
    <div id="categories" class="w-section section section-products">
        <h1 class="section-heading">CATEGORIES</h1>
        @foreach($categories->chunk(3) as $row)
            <div class="category-row">
                <div class="w-row column-row">
                    @foreach($row as $category)
                        <a href="/category/{{ $category->slug }}"><div class="w-col w-col-4">
                                <div class="category-wrapper">
                                    <div class="category-back-panel">
                                        <p>{{ $category->products->count() }} Products</p>
                                    </div>
                                    <div class="category-front-panel">
                                        <img class="category-image" src="{{ $category->smallestImageSrc() }}">
                                        <h1 class="category-heading">{{ $category->name }}</h1>
                                    </div>
                                </div>
                            </div></a>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section section-events">
        <h1 class="section-heading">FROM THE CLUBHOUSE</h1>
        @include('front.partials.upcomingevents')
        <div class="events-wrapper"></div>
    </div>
    <div class="w-section argyle-divider"></div>
    @include('front.partials.contact')
    <div class="w-section argyle-divider"></div>
@endsection

@section('bodyscripts')
    @include('admin.partials.flash')
    <script>
        var cartManager = new Vue(vueConstructorObjects.cartManager);
        var contactForm = new AjaxContactForm(document.getElementById('contact-form'));
        contactForm.init();
    </script>
    <script>
        var contactSlider = {
            triggers: document.querySelectorAll('.contact-panel-toggle'),
            slidePanel: document.querySelector('.contact-form-panel'),

            init: function() {
                var triggers = contactSlider.triggers;
                var l = triggers.length, i = 0;
                for(i;i<l;i++) {
                    contactSlider.triggers[i].addEventListener('click', contactSlider.toggle, false);
                }
            },

            toggle: function() {
                if(contactSlider.slidePanel.classList.contains('show')) {
                    contactSlider.slidePanel.classList.remove('show')
                } else {
                    contactSlider.slidePanel.classList.add('show')
                }
            }
        }
        contactSlider.init();
    </script>
@endsection