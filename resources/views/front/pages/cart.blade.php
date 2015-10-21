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
                        <div class="quantity">
                            <span v-if="syncingItems.indexOf(item.cartRowId) !== -1"><i class="fa fa-spinner fa-spin"></i></span>
                            <span v-if="editingItems.indexOf(item.cartRowId) === -1">@{{ item.quantity }}</span>
                            <input class="cart-item-qty-input"
                                   v-if="editingItems.indexOf(item.cartRowId) !== -1"
                                   type="number"
                                   min="1"
                                   v-model="item.quantity"
                            />
                            <div class="edit-save-btn"
                                 v-on="click: showEdit(item)"
                                 v-text="editingItems.indexOf(item.cartRowId) !== -1 ? 'save' : 'edit'"
                            ></div>
                        </div>
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
        <div class="argyle-divider shortened"></div>
        <div class="btn btn-checkout">
            <a href="/checkout">checkout</a>
        </div>
        <a class="back-to-shop-link" href="/">Back to shop</a>
    </div>
    <div class="w-section argyle-divider"></div>
@endsection

@section('bodyscripts')
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var cartManager = new Vue(vueConstructorObjects.cartManager);
        var cartListManager = new Vue(vueConstructorObjects.cartListManager);
    </script>
@endsection