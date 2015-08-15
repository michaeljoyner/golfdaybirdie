@extends('admin.base')

@section('content')
    <div class="gbb-page-header">
        <h1>Products</h1>
        <div class="btn gbb-btn header-action">
            <a href="/admin/products/create">Add Product</a>
        </div>
        <hr/>
    </div>
    @foreach($products->chunk(3) as $productRow)
        <div class="row">
            @foreach($productRow as $product)
                <div class="col-sm-4 product-box">
                    <div class="product-image-box">
                        <img src="{{ $product->imageSrc() }}" alt="product image"/>
                    </div>
                    <p class="product-title">{{ $product->name }}</p>
                    <div class="action-center pull-right">
                        <div class="btn gbb-btn btn-blue">
                            <a href="/admin/products/{{ $product->id }}/edit">Edit</a>
                        </div>
                        @include('admin.partials.deletebutton', [
                            'objectName' => $product->name,
                            'deleteFormAction' => '/admin/products/'.$product->id
                        ])
                    </div>
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