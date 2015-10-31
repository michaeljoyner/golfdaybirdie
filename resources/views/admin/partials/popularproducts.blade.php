<div class="popular-products clearfix">
    <ol class="popular-products-list">
        @foreach($popularProducts as $index => $product)
            <li>
                <span class="popular-position">{{ $index + 1 }}</span>
                <a href="/admin/products/{{ $product->id }}">
                    <img src="{{ $product->smallestImageSrc() }}" alt="product image"/>
                </a>
            </li>
        @endforeach
    </ol>

    @if($popularProducts->count() < 1)
        <h3>{{ $emptyMessage }}</h3>
    @endif
</div>