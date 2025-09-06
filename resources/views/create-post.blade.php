<x-layout>
    <div class="container py-md-5 container--narrow">
        <form action="/create-post" method="POST">
            @csrf
            <div class="form-group">
                <label for="post-title" class="text-muted mb-1">
                    <small>Title</small>
                </label>
                <input name="title" id="post-title" class="form-control form-control-lg form-control-title" type="text"
                    placeholder="" autocomplete="off" value="{{ old('title') }}" />
                @error('title')
                    <p class="alert alert-danger small mt-2 shadow-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="post-content" class="text-muted mb-1">
                    <small>Body Content</small>
                </label>
                <textarea name="content" id="post-content" class="body-content tall-textarea form-control" type="text">
                    {{ old('content') }}
                </textarea>
                @error('content')
                    <p class="alert alert-danger small mt-2 shadow-sm">{{ $message }}</p>
                @enderror
            </div>

            <button class="btn btn-primary">
                Save New Post
            </button>
        </form>
    </div>
</x-layout>
