@extends('admin.base')

@section('content')
    <h1>Add a new Product</h1>
    @include('admin.forms.product', [
        'formAction' => '/admin/products',
        'product' => $product,
        'submitText' => 'Add Product'
    ])
@endsection