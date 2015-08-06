@extends('admin.base')

@section('content')
    <h1>Add a new Category</h1>
    @include('admin.forms.category', ['formAction' => '/admin/categories', 'category' => $category, 'submitText' => 'Add Category'])
@endsection