<div class="w-nav nav-bar">
    <div class="main-nav">
    @if(Request::path() === '/')
        <div class="nav-phone">
            <span class="call-now">CALL&nbsp;NOW:</span>&nbsp;083 257 9611
        </div>
    @else
        <div class="nav-branding">
            <a href="/"><img src="{{ asset('images/logo_web.png') }}" alt="Golf Day Birdie logo small"/></a>
        </div>
    @endif
    <nav class="w-nav-menu nav-menu w-clearfix" role="navigation">
        <a class="w-nav-link nav-link about" href="/#categories">SHOP</a>
        <a class="w-nav-link nav-link contact" href="/#contact-us">CONTACT</a>
        <a class="w-nav-link nav-link cart" href="/cart">
            <div id="cart">
                QUOTE
                <div class="cart-summary-box" v-class="show: mustShow === true" v-cloak>
                    <p>Products: <span class="cart-product-count">@{{ summary.products }}</span></p>
                    <p>Total items: <span class="cart-item-count">@{{ summary.items }}</span></p>
                </div>
            </div>
        </a>
    </nav>
    </div>
    <nav class="small-only">
        <ul>
            <a href="/"><li>Home</li></a>
            <a href="/#contact-us"><li>Contact</li></a>
            <a href="/#categories"><li>SHOP</li></a>
        </ul>
    </nav>
</div>