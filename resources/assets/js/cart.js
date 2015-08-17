(function (w) {
    var d = w.document;

    function createElement(tag, text, attributes) {
        var el = d.createElement(tag);
        if(text) {
            el.innerHTML = text;
        }
        _.times(attributes.length, function(i) {
            el.setAttribute(attributes[i].key, attributes[i].value);
        });
        return el;
    }

    function Cart(el) {
        this.el = el;
        this.items = [];
        this.elems = {};

        this.createElements();
    }

    Cart.prototype = {

        requestAddition: function(itemId, success, error) {
            this.sendToCart(itemId, success, error)
        },

        addItem: function(item) {
            this.items.push(item);
            this.refresh();
        },

        createElements: function() {
            var itemCount = createElement('div', '0', [{key: 'id', value: 'cart-item-count'}]);
            var cartListBox = createElement('div', null, [{key: 'class', value: 'cart-box'}]);
            var cartList = createElement('ul', null, [{key: 'class', value: 'cart-list'}]);
            var proceedLink = createElement('div', 'Your cart is empty', [{key: 'class', value: 'btn gbb-btn'}, {key: 'id', value: 'empty-cart-warning'}]);
            var checkbox = createElement('input', null, [{key: 'type', value: 'checkbox'}, {key: 'id', value: 'list-control'}]);
            var label = createElement('label', 'View items', [{key: 'for', value: 'list-control'}]);

            this.el.appendChild(itemCount);

            this.el.appendChild(label);
            this.el.appendChild(checkbox);

            cartListBox.appendChild(cartList);
            cartListBox.appendChild(proceedLink);
            this.el.appendChild(cartListBox);

            this.elems.cartBox = cartListBox;
            this.elems.cartList = cartList;
            this.elems.itemCount = itemCount;
        },

        refresh: function() {
            this.updateCounter();
            this.renderListOfItems();
            this.attachListenersToRemoveButtons();
            this.addCheckoutButton();
        },

        renderListOfItems: function() {
            var self = this;
            this.elems.cartList.innerHTML = '';

            _.times(this.items.length, function(i) {
                self.addItemToList(self.items[i]);
            });
        },

        attachListenersToRemoveButtons: function() {
            var self = this;
            var removeBtns = d.querySelectorAll('.remove-item-btn');

            _.times(removeBtns.length, function(index) {
                removeBtns[index].addEventListener('click', self.requestRemoveItem.bind(self), false);
            });
        },

        addCheckoutButton: function() {
            var emptyWarning = d.getElementById('empty-cart-warning');
            var hasCheckoutBtn = d.getElementById('checkout-btn');
            var checkoutBtn = createElement('a', 'Checkout', [{key: 'href', value: '/checkout'}, {key: 'id', value: 'checkout-btn'}]);
            if(emptyWarning) {
                emptyWarning.parentNode.removeChild(emptyWarning);
            } else {
                emptyWarning = createElement('div', 'Your cart is empty', [{key: 'class', value: 'btn gbb-btn'}, {key: 'id', value: 'empty-cart-warning'}]);
            }
            if(this.items.length > 0) {
                if(! hasCheckoutBtn) {
                    this.elems.cartBox.appendChild(checkoutBtn);
                }
            } else {
                if(hasCheckoutBtn) {
                    hasCheckoutBtn.parentNode.removeChild(hasCheckoutBtn);
                }
                this.elems.cartBox.appendChild(emptyWarning);
            }
        },

        requestRemoveItem: function(ev) {
            var itemId = ev.target.getAttribute('data-item-id');
            this.removeFromCart(itemId, function(){}, function(){});
        },

        removeItem: function(itemObj) {
            var self = this;
            var index = _.findIndex(self.items, function(item) {
                return item.id == itemObj.id;
            });
            this.items.splice(index, 1);
            this.refresh();
            this.resetProductButton(itemObj.id);
        },

        addItemToList: function(item) {
            var li = createElement('li', '<span>' +item.name + '</span>', [{key: 'class', value: 'cart-list-item'}]);
            var removeButton = createElement('div', 'remove', [{key: 'data-item-id', value: item.id}, {key: 'class', value: 'remove-item-btn'}]);
            li.appendChild(removeButton);
            this.elems.cartList.appendChild(li);
        },

        sendToCart: function(itemId, success, error) {
            var self = this;

            function onSuccess(item) {
                self.addItem(item);
                success();
            }

            this.makeRequest('/cart/add/' + itemId, onSuccess, error);
        },

        removeFromCart: function(itemId, success, error) {
            var self = this;

            function onSuccess(item) {
                self.removeItem(item);
                success();
            }

            this.makeRequest('/cart/remove/' + itemId, onSuccess, error);
        },

        syncCart: function(callback) {
            var self = this;
            function syncItems(items) {
                var idList = [];
                self.items = [];
                _.times(items.length, function(i) {
                    self.addItem(items[i]);
                    idList.push(items[i].id);
                });
                callback(idList);
            }

            function failedToSync() {
                alert('Failed to sync')
            }



            this.makeRequest('/cart/contents/' + new Date().getTime(), syncItems, failedToSync);
        },

        makeRequest: function(url, success, error) {
            var item;
            var req = new XMLHttpRequest();
            req.open('GET', url, true);
            req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            req.onreadystatechange = function(ev) {
                if(req.readyState === 4) {
                    if(req.status === 200) {
                        item = JSON.parse(ev.target.response);
                        success(item);
                    } else {
                        alert('Failed to add to cart');
                        error();
                    }
                }
            }
            req.send();
        },

        updateCounter: function() {
            this.elems.itemCount.innerHTML = this.items.length;
        },

        resetProductButton: function(itemId) {
            var button = d.getElementById('btn_' + itemId);
            button.innerHTML = 'Add to Cart';
            button.className = 'button product product-btn';
        }
    }
    w.Cart = Cart;
}(window));