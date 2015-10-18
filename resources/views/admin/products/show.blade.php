@extends('admin.base')

@section('head')
    <meta id="x-token" property="CSRF-token" content="{{ Session::token() }}"/>
@stop

@section('content')
    <div class="gbb-page-header">
        <h1 class="product-show-title">{{ $product->name }}</h1>
        <div class="header-action">
            <div class="btn gbb-btn btn-blue">
                <a href="/admin/products/{{ $product->id }}/edit">Edit</a>
            </div>
            @include('admin.partials.deletebutton', [
                'objectName' => $product->name,
                'deleteFormAction' => '/admin/products/'.$product->id
            ])
        </div>
        <hr/>
    </div>
    <div id="product-show" data-product-id="{{ $product->id }}" class="row product-show">
        <div class="col-md-7 product-details-box">
            <p class="product-description">{{ $product->description }}</p>
            <hr/>
            <div class="gbb-page-header">
                <h3>Variants</h3>
                <div class="btn gbb-btn header-action">
                    <a href="/admin/products/{{ $product->id }}/versions/create">Add Variant</a>
                </div>
                <hr/>
            </div>
            @if($product->versions->count() > 0)
                @foreach($product->versions as $version)
                    <div class="version-box">
                        <div class="actions">
                            <div class="btn gbb-btn btn-blue"><a href="/admin/versions/{{ $version->id }}/edit">Edit</a></div>
                            @include('admin.partials.deletebutton', [
                                'objectName' => $product->name.' - '.$version->version_name,
                                'deleteFormAction' => '/admin/versions/'.$version->id
                            ])
                        </div>
                        <img src="{{ $version->smallestImageSrc() }}" alt="product variant"/>
                        <p><strong>{{ $version->version_name }}</strong></p>
                    </div>
                @endforeach
            @else
                <p>This product has no variants.</p>
            @endif
            <hr/>
            <h3>Sizes</h3>
            <div class="size-box" id="sizes">
                <div v-cloak>
                    <div class="size-tag" v-repeat="size in sizes" v-on="click: removeSize(size)">
                        @{{ size }}
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <input
                                placeholder="Enter a new size"
                                class="form-control size-input"
                                type="text"
                                v-model="new_size"
                                v-on="keypress: addSize | key 'enter'"
                        />
                    </div>
                    <div class="col-md-4">
                        <span v-if="syncing" class="syncing-notification">syncing...</span>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-5 product-image-box">
            <img src="{{ $product->imageSrc() }}" alt="product image"/>
        </div>
    </div>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/0.12.16/vue.min.js"></script>
    <script src="{{ asset('js/vue-resource.min.js') }}"></script>

    @include('admin.partials.modalscript')
    @include('admin.partials.flash')
    <script>
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#x-token').getAttribute('content');
        var sizes = new Vue({
            el: '#sizes',
            data: {
                sizes: [],
                new_size: '',
                syncOperations: 0
            },
            computed: {
                syncing: function() {
                    return this.syncOperations > 0;
                }
            },
            ready: function() {
                this.$set('product_id', document.querySelector('#product-show').getAttribute('data-product-id'));
                this.getSizes();
            },
            methods: {
                getSizes: function() {
                    this.syncOperations++;
                    this.$http.get('/admin/api/products/' + this.product_id +'/sizes', function(sizes) {
                        this.$set('sizes', sizes);
                        this.syncOperations--;
                    });
                },
                syncSizes: function() {
                    this.syncOperations++;
                    this.$http.post('/admin/api/products/' + this.product_id +'/sizes', {sizes: this.sizes},  function(sizes) {
                        this.$set('sizes', sizes);
                        this.syncOperations--;
                    });
                },
                addSize: function() {
                    if(!this.new_size) {
                        return;
                    }
                    this.sizes.push(this.new_size);
                    this.new_size = '';
                    this.syncSizes();
                },
                removeSize: function(size) {
                    this.sizes.$remove(size);
                    this.syncSizes();
                }
            }
        });
    </script>
@endsection