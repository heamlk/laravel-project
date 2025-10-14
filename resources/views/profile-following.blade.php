<x-profile :profileSharedData="$profileSharedData" docTitle="Who {{ $profileSharedData['user']->username }} Follows">
    <div class="list-group">
        @foreach ($following as $follow)
            <a wire:navigate href="/profile/{{ $follow->userFollowed->username }}"
                class="list-group-item list-group-item-action">
                <img class="avatar-tiny" src="{{ asset($follow->userFollowed->avatar) }}" />
                {{ $follow->userFollowed->username }}
            </a>
        @endforeach
    </div>
</x-profile>
