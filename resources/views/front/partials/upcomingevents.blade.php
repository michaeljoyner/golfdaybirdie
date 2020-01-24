<div class="w-container">
    @if($announcements->count() > 1)
    <div class="w-row column-row">
        @if($announcements->count() > 1)
        <div class="w-col w-col-6 upcoming-event">
            <h2 class="event-title">{{ $announcements->first()->title }}</h2>
            <p class="event-text">{{ $announcements->first()->body }}</p>
            <p class="event-date">{{ $announcements->first()->subscript }}</p>
        </div>
        <div class="w-col w-col-6 upcoming-event">
            <h2 class="event-title">{{ $announcements->last()->title }}</h2>
            <p class="event-text">{{ $announcements->last()->body }}</p>
            <p class="event-date">{{ $announcements->last()->subscript }}</p>
        </div>
        @else
            <div class="w-col w-col-12 upcoming-event">
                <h2 class="event-title">{{ $announcements->first()->title }}</h2>
                <p class="event-text">{{ $announcements->first()->body }}</p>
                <p class="event-date">{{ $announcements->first()->subscript }}</p>
            </div>
        @endif
    </div>
    @endif
</div>