<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script>
    </script>
    <style>
        html {
            box-sizing: border-box;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .product-box {
            width: 33%;
            display: inline-block;
            padding: 30px;
            text-align: center;
        }

        .product-box .img {
            display: block;
            width: 200px;
            margin: 0 auto;
        }

        .product-name {
            font-family: Helvetica, Ariel, sans-serif;
            color: #333;
            text-transform: uppercase;
        }

        body {
            padding-top: 60px;
        }

        #thecart {
            width: 80px;
            height: 60px;
            position: absolute;
            top: 10px;
            right: 0;
            margin: 10px;

        }

        #cart-item-count {
            width: 22px;
            height: 22px;
            position: absolute;
            top: -11px;
            left: -11px;
            border: 2px solid white;
            border-radius: 50%;
            color: white;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            font-family: Helvetica, Ariel, sans-serif;
            background: dodgerblue;
        }

        #thecart label {
            color: transparent;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url(../images/carticon.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: 50%;
        }

        .cart-box {
            position: absolute;
            top: 65px;
            right: 0;
            width: 20em;
            background: #333;
            border-radius: 10px;
            opacity: 0;
            transition: 1s;
        }

        .cart-box a {
            text-transform: uppercase;
            text-decoration: none;
            font-family: Helvetica, sans-serif;
            float: right;
            color: white;
            padding: 6px;
            background-color: #333;
        }



        #list-control {
            display: none;
        }

        #list-control:checked + .cart-box {
            opacity: 1;
        }


        .cart-list {
            list-style-type: none;
            transition: 1s;
        }

        .cart-list li {
            font-family: Helvetica, Ariel, sans-serif;
            position: relative;
            padding: 5px;
            border-top: 1px solid #808080;
            border-bottom: 1px solid #808080;
            color: #ffffff;
            margin-bottom: 3px;
        }

        .cart-list li .remove-item-btn {
            display: inline-block;
            float: right;
            background: orangered;
            color: #ffffff;
            font-family: Helvetica, Ariel, sans-serif;
            height: 18px;
            font-size: 12px;
            padding: 2px;
        }

        .product-btn {
            padding: 8px;
            width: 10em;
            text-align: center;
            background: orangered;
            color: white;
            font-family: Helvetica, Ariel, sans-serif;
            border-radius: 0;
            transition: .7s;
            margin: 30px auto;
        }

        .product-btn.added {
            background: #333;
            color: orangered;
        }
    </style>
</head>
<body>
<form action="">
    <imput type="hidden" value="0" id="dirty-bit"></imput>
</form>
    <div id="thecart">

    </div>
    @foreach($products as $product)
        <div class="product-box">
            <h3 class="product-name">{{ $product->name }}</h3>
            <img src="{{ $product->imageSrc() }}" alt="pic" width="200" height="200"/>
            <div id="btn_{{ $product->id }}" data-product-id="{{ $product->id }}" class="product-btn">
                Add to Cart
            </div>
        </div>
    @endforeach
    <script src="{{ asset('js/all.js') }}"></script>
    <script>
        var cartManager = {

            cart: null,

            init: function() {
                this.setDirty();
                var buttons = document.querySelectorAll('.product-btn');

                for(var i = 0; i < buttons.length; i++) {
                    buttons[i].addEventListener('click', cartManager.addItemToCart, false);
                }

                cartManager.cart = new Cart(document.getElementById('thecart'));
                cartManager.cart.syncCart(this.syncButtons.bind(this));
            },

            setDirty: function() {
                var dirt = document.getElementById('dirty-bit');
                dirt.value = 1;
                console.log('setting dirt');
            },

            addItemToCart: function(ev) {
                var button = ev.target;

                if(button.className === 'product-btn added') {
                    return;
                }
                var buttonId = button.getAttribute('data-product-id');

                button.innerHTML = 'Adding...';

                var added = function() {
                    button.innerHTML = 'In Your Cart';
                    button.className = 'product-btn added';
                }

                var failed = function() {
                    button.innerHTML = 'Add to Cart';
                    alert('Failed to add to cart');
                }
                cartManager.cart.requestAddition(buttonId, added, failed);
            },

            syncButtons: function(idList) {
                var id;
                var buttons = document.querySelectorAll('.product-btn');
                _.times(buttons.length, function(i) {
                   id = parseInt(buttons[i].id.substr(4));
                    if(_.indexOf(idList, id) !== -1) {
                        buttons[i].className = 'product-btn added';
                        buttons[i].innerHTML = 'In Your Cart';
                    }
                });
            },

//            addedItemToCart: function(itemId) {
//                var button = document.getElementById('btn_' + itemId);
//                button.innerHTML = 'Added to cart!';
//            },

            setButtonInCart: function() {

            }
        }
        cartManager.init();
        if(document.getElementById('dirty-bit').value == 1) {
            console.log('cleaning')
            cartManager.cart.syncCart(cartManager.syncButtons);
        }
    </script>
</body>
</html>