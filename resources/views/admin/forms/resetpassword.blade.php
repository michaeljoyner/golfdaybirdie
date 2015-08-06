{!! Form::open(['class' => 'form-horizontal']) !!}
<div class="form-group">
    <label for="current_password">Current Password: </label>
    {!! Form::password('current_password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password">New Password: </label>
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <label for="password_confirmation">Confirm Password: </label>
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    <button type="submit" class="btn">Reset</button>
</div>
{!! Form::close() !!}