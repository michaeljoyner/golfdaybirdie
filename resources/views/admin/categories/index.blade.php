@extends('admin.base')

@section('content')
<div class="gbb-page-header">
    <h1>Categories</h1>
    <div class="btn gbb-btn header-action">
        <a href="/admin/categories/create">Add Category</a>
    </div>
    <hr/>
</div>
@foreach($categories->chunk(3) as $categoriesRow)
<div class="row">
    @foreach($categoriesRow as $category)
    <div class="col-sm-4 product-box">
        <h3 class="category-name">{{ $category->name }}</h3>
        <div class="product-image-box">
            <a href="/admin/categories/{{ $category->id }}"><img src="{{ $category->smallestImageSrc() }}" alt="category image"/></a>
        </div>
        <div class="action-center pull-right">
            <div class="btn gbb-btn btn-blue">
                <a href="/admin/categories/{{ $category->id }}/edit">Edit</a>
            </div>
            @include('admin.partials.deletebutton', [
            'objectName' => $category->name,
            'deleteFormAction' => '/admin/categories/'.$category->id
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