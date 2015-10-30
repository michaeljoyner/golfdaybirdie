@extends('admin.base')

@section('head')
    <link href='https://fonts.googleapis.com/css?family=Bitter:400,700' rel='stylesheet' type='text/css'>
@endsection

@section('content')
    <div class="gbb-page-header">
        <h1>Announcements</h1>
        <div class="btn gbb-btn header-action btn-blue">
            <a href="/admin/announcements/create">New Announcement</a>
        </div>
        <hr/>
    </div>
    <div class="admin-announcements">
        @foreach($announcements as $announcement)
            <div class="announcement-wrapper">
                <div class="announcement-actions pull-right">
                    <a href="/admin/announcements/{{ $announcement->id }}/edit">
                        <div class="btn gbb-btn btn-blue">Edit</div>
                    </a>
                    @include('admin.partials.deletebutton', [
                        'objectName' => $announcement->title,
                        'deleteFormAction' => '/admin/announcements/'.$announcement->id
                    ])
                </div>
                <div class="upcoming-event">
                    <h1 class="event-title">{{ $announcement->title }}</h1>
                    <p class="event-text">{{ $announcement->body }}</p>
                    <p class="event-date">{{ $announcement->subscript }}</p>
                </div>
            </div>
        @endforeach
    </div>
    @include('admin.partials.deletemodal')
@endsection

@section('bodyscripts')
    @include('admin.partials.modalscript')
    @include('admin.partials.flash')
@endsection