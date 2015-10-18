@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Edit this Category</h1>
    <div class="row">
        <div class="col-md-7">
            @include('admin.forms.category', [
            'category' => $category,
            'formAction' => '/admin/categories/'.$category->id,
            'submitText' => 'Save Changes',
            'formId' => 'category-edit'
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
        var dzManager = new DropzoneManager('categoryPicDropzone', 'category-edit', 'category-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection