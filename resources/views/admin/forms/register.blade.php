<form class="form-horizontal isomark-form" role="form" method="POST" action="/admin/users/register">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="form-group">
        <label class="control-label">Name</label>
        <div class="col-md-12">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label">E-Mail Address</label>
        <div class="col-md-12">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label">Password</label>
        <div class="col-md-12">
            <input type="password" class="form-control" name="password">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label">Confirm Password</label>
        <div class="col-md-12">
            <input type="password" class="form-control" name="password_confirmation">
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12">
            <button type="submit" class="btn prompt-button form-control">
                Register User
            </button>
        </div>
    </div>
</form>