<x-layout :docTitle="$docTitle">
    <div class="container py-md-5 container--narrow">
        <div class="row d-flex align-items-center gap-2">
            <img class="avatar-small" src="{{ asset($profileSharedData['user']->avatar) }}" />
            <h2>{{ $profileSharedData['user']->username }}</h2>

            @auth
                @if (!$profileSharedData['currentlyFollowing'] && auth()->user()->id != $profileSharedData['user']->id)
                    <livewire:add-follow :username="$profileSharedData['user']->username" />
                @endif

                @if ($profileSharedData['currentlyFollowing'])
                    <livewire:remove-follow :username="$profileSharedData['user']->username" />
                @endif

                @if (auth()->user()->username == $profileSharedData['user']->username)
                    <a wire:navigate href="/manage-avatar" class="btn btn-secondary btn-sm m-2">Manage Avatar</a>
                @endif
            @endauth
        </div>

        <div class="profile-nav nav nav-tabs pt-2 mb-4">
            <a wire:navigate href="/profile/{{ $profileSharedData['user']->username }}"
                class="profile-nav-link nav-item nav-link {{ request()->routeIs('profile.posts') ? 'active' : '' }}">
                Posts: {{ $profileSharedData['postCount'] }}
            </a>
            <a wire:navigate href="/profile/{{ $profileSharedData['user']->username }}/followers"
                class="profile-nav-link nav-item nav-link {{ request()->routeIs('profile.followers') ? 'active' : '' }}">
                Followers: {{ $profileSharedData['followerCount'] }}
            </a>
            <a wire:navigate href="/profile/{{ $profileSharedData['user']->username }}/following"
                class="profile-nav-link nav-item nav-link {{ request()->routeIs('profile.following') ? 'active' : '' }}">
                Following: {{ $profileSharedData['followingCount'] }}
            </a>
        </div>

        <div class="profile-slot-content">
            {{ $slot }}
        </div>
    </div>
</x-layout>
