@extends('admin.base')

@section('content')
    <h1>Reset password for {{ Auth::user()->name }}</h1>
    @include('errors')
    @include('admin.forms.resetpassword')
@endsection