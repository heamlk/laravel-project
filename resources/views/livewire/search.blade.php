<div>
    <input type="text" wire:model.live="searchTerm">
    @if (count($results) > 0)
        <ul>
            @foreach ($results as $post)
                <li>{{ $post->title }}</li>
            @endforeach
        </ul>
    @endif
</div>
