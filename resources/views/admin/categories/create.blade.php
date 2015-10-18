@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Add a new Category</h1>
    <div class="row">
        <div class="col-md-7">
            @include('admin.forms.category', [
                'formAction' => '/admin/categories',
                'category' => $category,
                'submitText' => 'Add Category',
                'formId' => 'category-create'
            ])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', [
                'currentImg' => $category->imageSrc(),
                'uploadUrl' => '/admin/uploads/categoryimg',
                'dzFormId' => 'category-pic-dropzone',
                'previewId' => 'image-preview'
            ])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('categoryPicDropzone', 'category-create', 'category-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection