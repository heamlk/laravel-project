<form wire:submit="save" action="/post/{{ $post->id }}" method="POST">
    <p>
        <small>
            <strong>
                <a wire:navigate href="/post/{{ $post->id }}">
                    &laquo; Back to post permalink
                </a>
            </strong>
        </small>
    </p>
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="post-title" class="text-muted mb-1">
            <small>Title</small>
        </label>
        <input wire:model="title" name="title" id="post-title" class="form-control form-control-lg form-control-title"
            type="text" placeholder="" autocomplete="off" value="{{ old('title', $post->title) }}" />
        @error('title')
            <p class="alert alert-danger small mt-2 shadow-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="post-content" class="text-muted mb-1">
            <small>Body Content</small>
        </label>
        <textarea wire:model="content" name="content" id="post-content" class="body-content tall-textarea form-control"
            type="text">{{ old('content', $post->content) }}</textarea>
        @error('content')
            <p class="alert alert-danger small mt-2 shadow-sm">{{ $message }}</p>
        @enderror
    </div>

    <button class="btn btn-primary">
        Save Changes
    </button>
</form>
