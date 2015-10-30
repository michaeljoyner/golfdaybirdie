@extends('admin.base')

@section('content')
    <h1>Edit this Announcement</h1>
    @include('admin.forms.announcementform', [
        'announcement' => $announcement,
        'formAction' => '/admin/announcements/'.$announcement->id,
        'submitText' => 'Save Changes'
    ])
@endsection