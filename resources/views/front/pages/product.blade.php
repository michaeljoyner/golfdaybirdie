@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    @include('front.partials.ogmetatags', [
        'ogImage' => $product->imageSrc(),
        'ogTitle' => 'Golf Day Birdie | '.$product->name,
        'ogDescription' => $product->description
    ])
@stop

@section('content')
    <div class="back-function">
        <div class="back-text">
            <a class="breadcrumb-link" href="/">Home</a>
            <a class="breadcrumb-link" href="/category/{{ $product->category->slug }}">{{ $product->category->name }}</a>
            <span class="breadcrumb-final">{{ $product->name }}</span>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section">
        <div id="product-manager" data-product-id="{{ $product->id }}" class="w-row item-row product-show-section">
            <div class="w-col w-col-6 item-image-column" v-class="showit: isReady">
                <div class="main-item-image-wrapper">
                    <div class="product-main-img-wrapper">
                        <img v-model="displayImg" class="item-main-image" v-attr="src:imageToDisplay" alt=""/>
                    </div>
                </div>
                <div class="thumbnail-images-wrapper">
                    <p v-if="versions.length > 0" class="thumbnail-text">Click thumbnail to see Large image</p>
                    @if($product->versions->count() > 0)
                        <img class="product-version-thumb default-thumb" v-on="click: clearVersion" src="{{ $product->smallestImageSrc() }}" alt=""/>
                    @endif
                    <img class="product-version-thumb"
                         v-repeat="version in versions"
                         v-on="click: setVersion(version)"
                         v-attr="src:version.image_path"
                         alt="product thumbnail"
                    />
                </div>
            </div>
            <div class="w-col w-col-6 item-info-column">
                <div class="item-wrapper">
                    <h1 class="item-heading">
                        {{ $product->name }}
                        <span v-if="selectedVersion != null"> - @{{ selectedVersion.version_name }}</span>
                    </h1>
                    <span class="glyphicon glyphicon-cog"></span>
                    <div class="p">{{ $product->description }}</div>
                    <div class="item-quantity">
                        QUANTITY:
                        <input type="number" class="item-quantity-input form-control" min="1" v-model="quantity"/>
                    </div>
                    <div class="item-size">
                        <span v-if="sizes.length">SIZES: </span>
                        <div v-repeat="size in sizes"
                             class="product-size"
                             v-class="selected : size.id == selectedSize.id"
                             v-on="click: setSize(size)"
                        >
                            @{{ size.size }}
                        </div>
                    </div>
                    <div v-on="click: addToCart"
                         class="w-button add-button item"
                         v-class="disabled: requiresSize && ! selectedSize"
                    >
                        ADD TO CART
                        <span v-if="addingToCart" class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
@endsection

@section('bodyscripts')
    <script>
        var defaultProductImage = '{{ $product->imageSrc() }}';
    </script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var cartManager = new Vue(vueConstructorObjects.cartManager);
        var productManager = new Vue(vueConstructorObjects.productManager);
    </script>
@endsection