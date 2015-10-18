<div class="w-nav nav-bar" data-collapse="medium" data-animation="default" data-duration="400">
    <div class="nav-phone">
        <span class="call-now">CALL&nbsp;NOW:</span>&nbsp;083 257 9611
    </div>
    <nav class="w-nav-menu nav-menu" role="navigation">
        <a class="w-nav-link nav-link" href="/about">ABOUT</a>
        <a class="w-nav-link nav-link" href="#">CONTACT</a>
        <a class="w-nav-link nav-link" href="/cart">
            <div id="cart">
                CART
                <div class="cart-summary-box" v-class="show: mustShow === true" v-cloak>
                    <p>Products: <span class="cart-product-count">@{{ summary.products }}</span></p>
                    <p>Total items: <span class="cart-item-count">@{{ summary.items }}</span></p>
                </div>
            </div>
        </a>
    </nav>
</div>