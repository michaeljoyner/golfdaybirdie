@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <div id="products-list" class="products-list">
        <div class="products-page-header clearfix">
            <h1 class="page-title pull-left">Products</h1>
            <div class="input-group searchbar pull-right">
                <input v-model="searchTerm" v-on="keypress: search | key 'enter'" type="text" class="form-control" placeholder="Search products...">
                <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
            </div>
        </div>
        <hr/>
        <p class="results-header" v-if="performedSearch" v-cloak>Results for "@{{ performedSearch }}"</p>
        <ul class="results-list" v-cloak>
            <li v-repeat="result in results">
                <div class="result-item">
                    <img src="@{{ this.getResultImage(result) }}" alt="product image" class="result-image"/>
                    <a href="/admin/products/@{{ result.id }}"><span class="result-name">@{{ this.getResultName(result) }}</span></a>
                </div>
            </li>
            <p v-if="noResults" v-cloak>No results were found for "@{{ performedSearch }}"</p>
        </ul>
    </div>
@endsection

@section('bodyscripts')
    @include('admin.partials.flash')
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var productList = new Vue(vueConstructorObjects.adminProductList);
    </script>
@endsection
