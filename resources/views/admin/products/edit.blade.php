@extends('admin.base')

@section('content')
    <h1>Edit this Product</h1>
    @include('admin.forms.product', [
        'product' => $product,
        'formAction' => '/admin/products/'.$product->id,
        'submitText' => 'Save Changes'
    ])
@endsection