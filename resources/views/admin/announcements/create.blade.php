@extends('admin.base')

@section('content')
    <h1>Make a New Announcement</h1>
    @include('admin.forms.announcementform', [
        'formAction' => '/admin/announcements',
        'submitText' => 'Create Announcement'
    ])
@endsection