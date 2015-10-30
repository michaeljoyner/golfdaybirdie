{!! Form::model($announcement, ['url' => $formAction, 'class' => 'form-horizontal announcement-form']) !!}
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="title">Title</label>
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="body">Announcement body</label>
        {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <label for="subscript">Subscript</label>
        {!! Form::text('subscript', null, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <button class="btn gbb-btn" type="submit">{{ $submitText }}</button>
    </div>
{!! Form::close() !!}