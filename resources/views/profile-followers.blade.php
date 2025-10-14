<x-profile :profileSharedData="$profileSharedData" docTitle="{{ $profileSharedData['user']->username }}'s Followers">
    <div class="list-group">
        @foreach ($followers as $follower)
            <a wire:navigate href="/profile/{{ $follower->userFollowing->username }}"
                class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ asset($follower->userFollowing->avatar) }}" />
                {{ $follower->userFollowing->username }}
            </a>
        @endforeach
    </div>
</x-profile>
