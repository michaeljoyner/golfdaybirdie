@extends('front.base')

@section('head')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/velocity/1.2.2/velocity.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css') }}"/>
@endsection

@section('content')
    <form action="">
        <imput type="hidden" value="0" id="dirty-bit"></imput>
    </form>
    @include('front.partials.header')
    @include('front.partials.navbar')
    <div class="w-section hero">
        <h1 class="sectionheading">HOW&nbsp;IT&nbsp;WORKS</h1>
        <div class="w-container productscontainer">
            <div class="w-row">
                <div class="w-col w-col-4 stepcolumn first-step">
                    <div class="stepdiv"><img class="stepimage" src="images/homepage/step2.png">
                        <h1 class="stepheading">1.</h1>
                        <p class="steptext">CHOOSE A BALL FROM OUR SELECTION</p>
                    </div>
                </div>
                <div class="w-col w-col-4 stepcolumn">
                    <div class="stepdiv"><img class="stepimage" src="images/homepage/step1.png">
                        <h1 class="stepheading">2.</h1>
                        <p class="steptext">UPLOAD YOUR LOGO
                            <br>OR IMAGE</p>
                    </div>
                </div>
                <div class="w-col w-col-4 stepcolumn last-step">
                    <div class="stepdiv"><img class="stepimage" src="images/homepage/step3.png">
                        <h1 class="stepheading">3.</h1>
                        <p class="steptext">hazzah! your branding solution</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.partials.productsection', ['products' => $products])
    @include('front.partials.packaging')
    <div id="delivery-section" class="w-section deliversection">
        <h1 class="sectionheading">DELIVERY</h1>
        <div class="w-container delivercontainer">
            <p class="deliverytext">WE&nbsp;DELIVER&nbsp;THROUGHOUT SOUTHERN&nbsp;AFRICA.
                <br>
                <br>PLEASE&nbsp;<a class="hyperlink" href="#">CONTACT&nbsp;US</a>&nbsp;WITH&nbsp;ANY&nbsp;ENQUIRIES.</p><img class="deliveryimage" src="images/homepage/africamap.png">
        </div>
    </div>
    @include('front.partials.contact')
    @include('front.partials.footer')
@endsection

@section('bodyscripts')
    @include('admin.partials.confirmflash')
    <script src="{{ asset('js/cartmanager.js') }}"></script>
    <script>
        if(cartManager.cart === null) {
            cartManager.init();
        }
        if(document.getElementById('dirty-bit').value == 1) {
            console.log('cleaning')
            cartManager.cart.syncCart(cartManager.syncButtons);
        }
    </script>
    <script>
        var menuManager = {
            elems: {
                productsBtn: document.getElementById('nav-products'),
                deliveryBtn: document.getElementById('nav-delivery'),
                contactBtn: document.getElementById('nav-contact'),
                productsSec: document.getElementById('products-section'),
                deliverySec: document.getElementById('delivery-section'),
                contactSec: document.getElementById('contact-section')
            },

            init: function() {
                menuManager.elems.productsBtn.addEventListener('click', menuManager.showProducts, false);
                menuManager.elems.deliveryBtn.addEventListener('click', menuManager.showDelivery, false);
                menuManager.elems.contactBtn.addEventListener('click', menuManager.showContact, false);
            },

            showProducts: function() {
                Velocity(menuManager.elems.productsSec, 'scroll', 500);
            },

            showDelivery: function() {
                Velocity(menuManager.elems.deliverySec, 'scroll', 500);
            },

            showContact: function() {
                Velocity(menuManager.elems.contactSec, 'scroll', 500);
            }
        }
        menuManager.init();
    </script>
@endsection