<x-layout :docTitle="$post->title">
    <div class="container py-md-5 container--narrow">
        <div class="d-flex justify-content-between">
            <h2>{{ $post->title }}</h2>
            @can('update', $post)
                <span class="pt-2">
                    <a wire:navigate href="/post/{{ $post->id }}/edit" class="text-primary mr-2" data-toggle="tooltip"
                        data-placement="top" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <livewire:delete-post :post="$post" />
                </span>
            @endCan
        </div>

        <p class="text-muted small mb-4">
            <a wire:navigate href="/profile/{{ $post->user->username }}">
                <img class="avatar-tiny" src="{{ asset($post->user->avatar) }}" />
            </a>
            Posted by
            <a wire:navigate href="/profile/{{ $post->user->username }}">
                {{ $post->user->username }}
            </a>
            on {{ $post->created_at->format('F j, Y') }}
        </p>

        <div class="body-content">
            {!! $post->content !!}
        </div>
    </div>
</x-layout>
