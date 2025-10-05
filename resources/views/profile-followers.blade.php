<x-profile :profileSharedData="$profileSharedData">
    <div class="list-group">
        @foreach ($followers as $follower)
            <a href="/profile/{{ $follower->userFollowing->username }}" class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ asset($follower->userFollowing->avatar) }}" />
                {{ $follower->userFollowing->username }}
            </a>
        @endforeach
    </div>
</x-profile>
