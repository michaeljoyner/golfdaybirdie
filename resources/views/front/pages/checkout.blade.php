@extends('front.base')

@section('head')
    <meta property="CSRF-token" content="{{ Session::token() }}"/>
    <meta name="ROBOTS" content="NOINDEX, FOLLOW"/>
@endsection

@section('content')
    <div class="w-section argyle-banner about">
        <h1 class="section-heading mission">CHECKOUT</h1>
    </div>
    <div class="main-checkout-wrapper">
        <div class="w-row column-row">
            <div class="w-col-3 w-col checkout-order">
                <h1 class="checkout-heading">Your Order</h1>
                <ul class="checkout-order-list">
                @foreach($orderedItems as $item)
                    <li>{{ $item->quantity }} x <span class="checkout-order-item-name">{{ $item->itemName }}</span></li>
                @endforeach
                </ul>
                <h2 class="checkout-explaination-heading">What Happens Now?</h2>
                <p class="checkout-explaination">Once you send us this form you can sit back and let us take over. We will immediately process your order and get back to you with a quote and to organise your delivery. We take care of everything to make sure everything goes as smoothly as possible for you.</p>
            </div>
            <div class="w-col-6 w-col">
                <div class="w-section checkout-form-section">
                    <form class="gdb-form" action="/checkout" method="POST" id="checkout-form">
                        {!! csrf_field() !!}
                        <div class="gdb-form-group">
                            <label for="customer_name">Your Name: </label>
                            <input type="text" name="customer_name" required value="{{ old('customer_name') }}"/>
                        </div>
                        <div class="gdb-form-group">
                            <label for="customer_phone">Your Contact No: </label>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}"/>
                        </div>
                        <div class="gdb-form-group">
                            <label for="customer_email">Your Email: </label>
                            <input type="email" name="customer_email" required value="{{ old('customer_email') }}"/>
                        </div>
                        <div class="gdb-form-group">
                            <label for="customer_address">Your Address (for delivery): </label>
                            <textarea name="customer_address">{{ old('customer_address') }}</textarea>
                        </div>
                        <div class="gdb-form-group">
                            <label for="order_query">Additional Info: </label>
                            <textarea
                                    name="order_query"
                                    placeholder="If you have any further queries or instructions, please let us know here"
                            >{{ old('order_query') }}</textarea>
                        </div>

                        <div class="gdb-form-group">
                            <button type="submit">Place Order</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="w-col w-col-3 upload-column">
                <h1>Upload Your Logo</h1>
                <div action="/uploads/logos" id="logo-dropzone" class="dropzone uploadbutton">
                    CLICK OR DRAG FILES TO UPLOAD
                </div>
                <div id="image-preview" class="dropzone-pv dropzone-previews"></div>
            </div>
        </div>
    </div>
@endsection

@section('bodyscripts')
    <script>
        var helper = {
            getCSRFToken: function() {
                var metas = document.getElementsByTagName('meta');
                var i = 0, l = metas.length;
                for(i;i<l;i++) {
                    if(metas[i].getAttribute("property") == 'CSRF-token') {
                        return metas[i].getAttribute("content");
                    }
                }
                return "";
            },
            appendHiddenFieldToForm: function(formID, inputName, inputValue) {
                var form = document.getElementById(formID);
                var hiddenInput;
                hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', inputName);
                hiddenInput.setAttribute('value', inputValue);
                form.appendChild(hiddenInput);
                return;
            }
        };
        Dropzone.options.logoDropzone = {
            init: function() {
                this.on('sending', function(file, xhr, formData) {
                    formData.append('_token', helper.getCSRFToken());
                });
                this.on('success', function(file, response) {
                    helper.appendHiddenFieldToForm('checkout-form', 'logo_images[]', response);
                });
            },
            acceptedFiles: 'image/*',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            thumbnailWidth: 100,
            thumbnailHeight: null,
            dictDefaultMessage: '',
            previewsContainer: '#image-preview'
        };
    </script>
@endsection