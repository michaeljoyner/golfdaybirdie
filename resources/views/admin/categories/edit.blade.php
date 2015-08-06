@extends('admin.base')

@section('content')
    <h1>Edit this Category</h1>
    @include('admin.forms.category', [
        'category' => $category,
        'formAction' => '/admin/categories/'.$category->id,
        'submitText' => 'Save Changes'
    ])
@endsection