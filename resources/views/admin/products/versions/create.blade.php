@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Add a new version of {{ $product->name }}</h1>
    <div class="row">
        <div class="col-md-7">
            @include('admin.forms.productversion', [
                'formAction' => '/admin/products/'.$product->id.'/versions',
                'version' => $version,
                'submitText' => 'Add version',
                'formId' => 'version-create'
            ])
        </div>
        <div class="col-md-5">
            @include('admin.partials.dropzoneform', [
                'currentImg' => $version->imageSrc(),
                'uploadUrl' => '/admin/uploads/versionimg',
                'dzFormId' => 'version-pic-dropzone',
                'previewId' => 'image-preview'
            ])
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var dzManager = new DropzoneManager('versionPicDropzone', 'version-create', 'version-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection