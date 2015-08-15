@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Add a new Product</h1>
    <div class="row">
        <div class="col-sm-7">
            @include('admin.forms.product', [
                'formAction' => '/admin/products',
                'product' => $product,
                'submitText' => 'Add Product',
                'formId' => 'product-create'
            ])
        </div>
        <div class="col-sm-5">
            @include('admin.partials.dropzoneform', [
                'currentImg' => $product->imageSrc(),
                'uploadUrl' => '/admin/uploads/productimg',
                'dzFormId' => 'product-pic-dropzone',
                'previewId' => 'image-preview'
            ])
        </div>
    </div>

@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('productPicDropzone', 'product-create', 'product-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection