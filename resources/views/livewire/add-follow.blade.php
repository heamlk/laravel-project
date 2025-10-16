<form wire:submit="save" class="m-2 d-inline" action="/create-follow/{{ $profileSharedData['user']->username }}"
    method="POST">
    @csrf
    <button class="btn btn-primary btn-sm">
        Follow <i class="fas fa-user-plus"></i>
    </button>
</form>
