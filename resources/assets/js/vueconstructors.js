var vueConstructorObjects = {

    cartManager: {
        el: '#cart',
        data: {
            summary: {
                products: 0,
                items: 0
            },
            toShow: false
        },
        computed: {
            mustShow: function() {
                return this.toShow;
            }
        },
        ready: function () {
            this.sync();
        },
        methods: {
            sync: function () {
                this.$http.get('/cart/countitems', function (result) {
                    this.$set('summary', result.summary);
                    if(result.empty > 0) {
                        this.flash();
                    }
                });
            },
            flash: function() {
                var self = this;
                function reset() {
                    self.$set('toShow', false);
                }
                this.toShow = true;
                window.setTimeout(reset, 2000);
            }
        }
    },

    productManager: {
        el: '#product-manager',
        data: {
            quantity: 1,
            selectedSize: null,
            selectedVersion: null,
            addedToCart: false,
            displayImg: '',
            addingToCart: false,
            isReady: false
        },
        computed: {
            requiresSize: function() {
                return this.sizes && this.sizes.length > 0;
            },
            imageToDisplay: function() {
                return this.displayImg == '' ? this.defaultDisplayImg : this.displayImg;
            }
        },
        ready: function() {
            this.$set('versions', vueDataStore.versions);
            this.$set('sizes', vueDataStore.sizes);
            this.$set('defaultDisplayImg', defaultProductImage);
            this.$set('productId', document.querySelector('#product-manager').getAttribute('data-product-id'));
            this.$set('isReady', true);
        },
        methods: {
            setVersion: function(version) {
                this.displayImg = version.image_path.replace('thumb/', '');
                this.selectedVersion = version;
            },
            clearVersion: function() {
                this.displayImg = '';
                this.selectedVersion = null;
            },
            setSize: function(size) {
                this.selectedSize = size;
            },
            addToCart: function() {
                if(this.requiresSize && ! this.selectedSize) {
                    return;
                }
                this.addingToCart = true;
                this.$http.post('/cart/additem', {
                    id: this.productId,
                    version: this.selectedVersion ? this.selectedVersion.id : null,
                    size: this.selectedSize ? this.selectedSize.id : null,
                    quantity: this.quantity
                }, function(result) {
                    this.addingToCart = false;
                    cartManager.sync();
                    this.clearInputs();
                });
            },
            clearInputs: function() {
                this.selectedSize = null;
                this.quantity = 1;
            }
        }
    },

    adminProductSizes: {
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
    },

    adminProductList: {
        el: '#products-list',
        data: {
            results: [],
            searchTerm: '',
            performedSearch: ''
        },
        computed: {
            noResults: function() {
                return this.performedSearch != '' && this.results.length === 0;
            }
        },
        ready: function() {
            this.$http.get('/admin/api/products/allproducts' + this.performedSearch, function(products) {
                this.$set('results', products);
            });
        },
        methods: {
            search: function() {
                this.performedSearch = this.searchTerm;
                this.searchTerm = '';
                this.$http.get('/admin/api/products/' + this.performedSearch, function(products) {
                    this.$set('results', products);
                });
            },
            getResultImage: function(result) {
                if(result.versions.length > 0) {
                    return result.versions[0].image_path;
                }
                return result.image_path;
            },
            getResultName: function(result) {
                if(result.versions.length > 0) {
                    return result.name + " - " + result.versions[0].version_name;
                }
                return result.name;
            }
        }
    },

    cartListManager: {
        el: '#cart-items',
        data: {
            items: [],
            editingItems: [],
            syncingItems: []
        },
        computed: {
            inEditMode: function(item) {
                return this.editingItems.indexOf(item.cartRowId) !== -1;
            }
        },
        ready: function () {
            this.$set('items', vueDataStore.items);
        },
        methods: {
            removeItem: function (item) {
                this.$http.delete('/cart/' + item.cartRowId, function (result) {
                    this.items.$remove(item);
                    cartManager.sync();
                }).error(function (data) {
                    console.log(data);
                })
            },
            showEdit: function(item) {
                if(this.editingItems.indexOf(item.cartRowId) === -1) {
                    this.editingItems.push(item.cartRowId);
                    return;
                }
                this.syncingItems.push(item.cartRowId);
                this.$http.post('/cart/update/' + item.cartRowId, {item: item}, function(result) {
                    this.editingItems.$remove(item.cartRowId);
                    this.syncingItems.$remove(item.cartRowId);
                    cartManager.sync();
                });
            }
        }
    },

    adminProductPromote: {
        el: '#promote',

        data: {
            shouldPromote: false,
            isSyncing: false
        },

        ready: function() {
            this.$set('product_id', document.querySelector('#product-show').getAttribute('data-product-id'));
        },

        methods: {
            togglePromote: function() {
                this.isSyncing = true;
                this.$http.post('/admin/api/products/promote/' + this.product_id, {}, function(result) {
                   this.$set('shouldPromote', result.promote);
                    this.$set('isSyncing', false);
                });
            }
        }
    }
}