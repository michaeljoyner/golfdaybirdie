@extends('admin.base')

@section('content')
    <div class="row">
        <div class="col-md-7">
            @foreach($users as $user)
                @include('admin.users.partials.usercard', ['user' => $user])
            @endforeach
        </div>
        <div class="col-md-5">
            <h2>Register a New User</h2>
            @include('errors')
            @include('admin.forms.register')
        </div>
    </div>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
@endsection