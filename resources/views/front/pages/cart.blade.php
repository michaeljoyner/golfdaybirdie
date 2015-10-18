@extends('front.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
@stop

@section('content')
    <div class="w-section argyle-banner about">
        <h1 class="section-heading mission">YOUR CART</h1>
    </div>
    <div class="w-section section cart-product">
        <ul id="cart-items" v-if="items.length" class="cart-list">
            <li v-repeat="item in items">
                <div class="w-clearfix cart-product-wrapper">
                    <div class="cart-wrapper cart-image"><img class="cart-image" width="120"
                                                              src="@{{ item.images['thumb'] }}">
                    </div>
                    <div class="cart-wrapper title">
                        <div class="cart-title">@{{ item.itemName }}</div>
                    </div>
                    <div class="cart-wrapper size">
                        <div class="size">@{{ item.size }}</div>
                    </div>
                    <div class="cart-wrapper quantity">
                        <div class="quantity">@{{ item.quantity }}</div>
                    </div>
                    <div class="cart-wrapper delete">
                        <span v-on="click: removeItem(item)"><i class="fa fa-trash"></i></span>
                    </div>
                </div>
            </li>
            <li v-if="items.length < 1">
                <p class="cart-list-empty">Your cart is currently empty.</p>
            </li>
        </ul>
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

        var cartListManager = new Vue({
            el: '#cart-items',
            data: {
                items: []
            },
            ready: function () {
                this.$set('items', vueDataStore.items);
            },
            methods: {
                removeItem: function (item) {
                    this.$http.delete('/cart/' + item.cartRowId, function (result) {
                        this.items.$remove(item);
                        cartManager.sync();
                    }).error(function (data) {
                        console.log(data);
                    })
                }
            }
        });
    </script>
@endsection