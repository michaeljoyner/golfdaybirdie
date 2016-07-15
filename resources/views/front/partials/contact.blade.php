<section class="contact-section section" id="contact-us">
    <h1 class="section-heading">HOW TO GET IN TOUCH</h1>
    <div class="contact-display-panel">
        <div class="w-container">
            <div class="w-row column-row">
                <div class="w-col w-col-4 contact-col">
                    <h1 class="contact-icon-heading">call us now</h1>
                    <div class="contact-icon-box">
                        @include('svg.newphone')
                    </div>
                    <p class="contact-detail">+27 83 257 9611</p>
                </div>
                <div class="w-col w-col-4 contact-col">
                    <h1 class="contact-icon-heading">mail us</h1>
                    <div class="contact-icon-box">
                        @include('svg.newemail')
                    </div>
                    <p class="contact-detail"><a href="mailto:sales@golfdaybirdie.co.za">sales@golfdaybirdie.co.za</a></p>
                </div>
                <div class="w-col w-col-4 contact-col">
                    <h1 class="contact-icon-heading">send a message</h1>
                    <div class="contact-icon-box contact-panel-toggle">
                        @include('svg.newmessage')
                    </div>
                    <div class="contact-panel-toggle open-btn">Send message now</div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-form-panel">
        @include('front.partials.contactform')
    </div>
</section>