@extends('admin.base')

@section('content')
    <div class="gbb-page-header">
        <h1>{{ $category->name }}</h1>
        <div class="btn gbb-btn header-action">
            <a href="/admin/categories/{{ $category->id }}/addproduct">Add Product</a>
        </div>
        <hr/>
    </div>
    <h2 class="sub-section-heading">Products in this Category</h2>
    @foreach($category->products->chunk(3) as $productRow)
        <div class="row">
            @foreach($productRow as $product)
                <div class="col-sm-4 product-box">
                    <div class="product-image-box">
                        <a href="/admin/products/{{ $product->id }}"><img src="{{ $product->smallestImageSrc() }}" alt="product image"/></a>
                    </div>
                    <p class="product-title">{{ $product->name }}</p>
                </div>
            @endforeach
        </div>
    @endforeach
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    @include('admin.partials.flash')
@endsection