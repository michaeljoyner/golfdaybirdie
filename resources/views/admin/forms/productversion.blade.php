{!! Form::model($version, ['url' => $formAction, 'class' => 'form-horizontal', 'id' => $formId]) !!}
<div class="form-group">
    <label for="name">Version name: </label>
    {!! Form::text('version_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <label for="description">Description: </label>
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    <button class="btn gbb-btn" type="submit">{{ $submitText }}</button>
</div>
{!! Form::close() !!}