<x-layout>
    <div class="container py-md-5 container--narrow">
        <div class="row d-flex align-items-center gap-2">
            <img class="avatar-small" src="{{ asset($user->avatar) }}" />
            <h2>{{ $user->username }}</h2>

            @auth
                @if (!$currentlyFollowing && auth()->user()->id != $user->id)
                    <form class="m-2 d-inline" action="/create-follow/{{ $user->username }}" method="POST">
                        @csrf
                        <button class="btn btn-primary btn-sm">
                            Follow <i class="fas fa-user-plus"></i>
                        </button>
                    </form>
                @endif

                @if ($currentlyFollowing)
                    <form class="m-2 d-inline" action="/remove-follow/{{ $user->username }}" method="POST">
                        @csrf
                        <button class="btn btn-danger btn-sm">
                            Stop Following <i class="fas fa-user-times"></i>
                        </button>
                    </form>
                @endif

                @if (auth()->user()->username == $user->username)
                    <a href="/manage-avatar" class="btn btn-secondary btn-sm m-2">Manage Avatar</a>
                @endif
            @endauth
        </div>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a href="#" class="profile-nav-link nav-item nav-link active">Posts: {{ $postCount }}</a>
            <a href="#" class="profile-nav-link nav-item nav-link">Followers: 3</a>
            <a href="#" class="profile-nav-link nav-item nav-link">Following: 2</a>
        </div>

        <div class="list-group">
            @foreach ($posts as $post)
                <a href="/post/{{ $post->id }}" class="list-group-item list-group-item-action">
                    <img class="avatar-tiny" src="{{ asset($post->user->avatar) }}"} />
                    <strong>{{ $post->title }}</strong> on {{ $post->created_at->format('n/j/Y') }}
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
