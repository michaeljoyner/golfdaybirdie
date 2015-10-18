@extends('admin.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <h1>Edit this product variant</h1>
    <div class="row">
        <div class="col-md-7">
            @include('admin.forms.productversion', [
                'formAction' => '/admin/versions/'.$version->id,
                'version' => $version,
                'submitText' => 'Save changes',
                'formId' => 'version-edit'
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
        var dzManager = new DropzoneManager('versionPicDropzone', 'version-edit', 'version-image', 'image_path', 'image-preview');
        dzManager.init();
    </script>
@endsection