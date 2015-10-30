<div class="popular-products clearfix">
    @foreach($popularProducts as $product)
        <div class="popular-item pull-left">
            <img src="{{ $product->smallestImageSrc() }}" alt="product image"/>
            <a href="/admin/products/{{ $product->id }}">
                <h4>{{ $product->name }}</h4>
            </a>
        </div>
    @endforeach
    @if($popularProducts->count() < 1)
        <h3>{{ $emptyMessage }}</h3>
    @endif
</div>