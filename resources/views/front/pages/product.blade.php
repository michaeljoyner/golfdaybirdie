@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@stop

@section('content')
    <div class="back-function">
        <div class="back-text">&lt; BACK</div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section">
        <div id="product-manager" data-product-id="{{ $product->id }}" class="w-row item-row product-show-section">
            <div class="w-col w-col-6 item-image-column">
                <div class="main-item-image-wrapper">
                    <img v-if="displayImg == ''" class="item-main-image" src="{{ $product->imageSrc() }}">
                    <img v-if="displayImg != ''" v-model="displayImg" class="item-main-image" src="@{{ displayImg }}" alt=""/>
                </div>
                <div class="thumbnail-images-wrapper">
                    <p v-if="versions.length > 0" class="thumbnail-text">Click thumbnail to see Large image</p>
                    @if($product->versions->count() > 0)
                        <img class="product-version-thumb default-thumb" v-on="click: clearVersion" src="{{ $product->smallestImageSrc() }}" alt=""/>
                    @endif
                    <img class="product-version-thumb"
                         v-repeat="version in versions"
                         v-on="click: setVersion(version)"
                         src="@{{ version.image_path }}"
                         alt=""
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var cartManager = new Vue({
            el: '#cart',
            data: {
                summary: {
                    products: 0,
                    items: 0
                },
                toShow: false
            },
            computed: {
                mustShow: function() {
                    return this.toShow;
                }
            },
            ready: function () {
                this.sync();
            },
            methods: {
                sync: function () {
                    this.$http.get('/cart/countitems', function (result) {
                        this.$set('summary', result.summary);
                        if(result.empty > 0) {
                            this.flash();
                        }
                    });
                },
                flash: function() {
                    var self = this;
                    function reset() {
                        console.log('resetting');
                        self.$set('toShow', false);
                    }
                    this.toShow = true;
                    window.setTimeout(reset, 2000);
                }
            }
        });

        var productManager = new Vue({
            el: '#product-manager',
            data: {
                quantity: 1,
                selectedSize: null,
                selectedVersion: null,
                addedToCart: false,
                displayImg: '',
                addingToCart: false
            },
            computed: {
                requiresSize: function() {
                    return this.sizes && this.sizes.length > 0;
                }
            },
            ready: function() {
                this.$set('versions', vueDataStore.versions);
                this.$set('sizes', vueDataStore.sizes);
                this.$set('productId', document.querySelector('#product-manager').getAttribute('data-product-id'));
            },
            methods: {
                setVersion: function(version) {
                    this.displayImg = version.image_path.replace('thumb/', '');
                    this.selectedVersion = version;
                },
                clearVersion: function() {
                    this.displayImg = '';
                    this.selectedVersion = null;
                },
                setSize: function(size) {
                    this.selectedSize = size;
                },
                addToCart: function() {
                    if(this.requiresSize && ! this.selectedSize) {
                        return;
                    }
                    this.addingToCart = true;
                    this.$http.post('/cart/additem', {
                        id: this.productId,
                        version: this.selectedVersion ? this.selectedVersion.id : null,
                        size: this.selectedSize ? this.selectedSize.id : null,
                        quantity: this.quantity
                    }, function(result) {
                        this.addingToCart = false;
                        cartManager.sync();
                        this.clearInputs();
                    });
                },
                clearInputs: function() {
                    this.selectedSize = null;
                    this.quantity = 1;
                }
            }
        });
    </script>
@endsection