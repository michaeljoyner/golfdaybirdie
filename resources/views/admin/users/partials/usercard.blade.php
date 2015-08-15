<div class="user-card">
    <h3>{{ $user->name }}</h3>
    <p class="user-email">{{ $user->email }}</p>
    <div class="user-card-actions">
        <div class="gbb-btn btn btn-blue">
            <a href="/admin/users/{{ $user->id }}/edit">Edit</a>
        </div>
        <button type="button" class="btn gbb-btn" data-objectname="{{ $user->name }}" data-action="/admin/users/{{ $user->id }}" data-toggle="modal" data-target="#confirm-delete-modal">
            Delete
        </button>
    </div>
</div>