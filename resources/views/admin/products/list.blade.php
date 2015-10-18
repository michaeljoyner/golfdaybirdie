@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <div id="products-list" class="page-title">
        <h1 class="page-title">Products</h1>
        <div class="input-group">
            <input type="text" class="form-control" id="exampleInputAmount" placeholder="Amount">
            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var productList = new Vue({

        });
    </script>
@endsection