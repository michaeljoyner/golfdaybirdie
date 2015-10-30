<h1 class="section-heading">Send a Message</h1>
<form id="contact-form" class="gdb-form" action="/contact" method="POST">
    {!! csrf_field() !!}
    <div class="gdb-form-group">
        <label for="name">Your name: </label>
        <input type="text" name="name" required value="{{ old('name') }}"/>
    </div>
    <div class="gdb-form-group">
        <label for="email">Email Address: </label>
        <input type="text" name="email" required value="{{ old('email') }}"/>
    </div>
    <div class="gdb-form-group">
        <label for="enquiry">How can we help you?</label>
        <textarea name="enquiry" cols="30" rows="8"></textarea>
    </div>
    <div class="gdb-form-group">
        <button type="submit">Send</button>
    </div>
    <div class="form-cover">
        <p id="cf-thanks">
            Thank you. We'll be in touch
        </p>
        <p id="cf-reset">Send another message.</p>
    </div>
</form>
<p class="close-prompt contact-panel-toggle">Close</p>