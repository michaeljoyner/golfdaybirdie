@extends('front.base')

@section('head')
    @include('front.partials.ogmetatags', [
        'ogImage' => asset('images/fb_image.png'),
        'ogTitle' => 'Golf Day Birdie | About Us',
        'ogDescription' => 'Golf Day Birdie is a proudly South African business that excels in offering companies and individuals all the necessary things they may need to make their golf day something to remember. We offer a wide range of quality products at very competitive prices.'
    ])
@endsection

@section('content')
    <div class="w-section argyle-divider"></div>
    <div class="w-section section mission-section">
        <h1 class="section-heading">OUR&nbsp;MISSION</h1>
        <div class="w-container mission-container">
            <div class="w-row mission-row">
                <div class="w-col w-col-4 mission-column-left">
                </div>
                <div class="w-col w-col-8 mission-column-right">
                    <div class="p">This is some text about Golf Day Birdie and it's mission.&nbsp;Bacon ipsum dolor amet pork prosciutto tongue porchetta drumstick biltong flank t-bone. Meatloaf pancetta kielbasa, cupim venison flank pork belly. Porchetta sirloin corned beef cow jowl, tongue meatball beef pig pork loin chuck boudin hamburger ribeye prosciutto.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
    <div class="w-section section delivery-section">
        <h1 class="section-heading">DELIVERY</h1>
        <div class="w-container delivery-container">
            <div class="delivery-text">Golf Day Birdie Delivers throughout Southern Africa</div><img class="delivery-image" src="images/delivery-map.jpg">
        </div>
    </div>
    <div class="w-section argyle-divider"></div>
@endsection

@section('bodyscripts')
    <script>
        var cartManager = new Vue(vueConstructorObjects.cartManager);
    </script>
@endsection