<div class="col-3 col-lg-3 col-xxl-1">
    <a href="{{ route('games.show', ['game' => $game]) }}"
       class="text-decoration-none rounded"
    >
        <img alt="{{ $game->name }}" class="rounded mb-2" src="{{ $game->getFirstMediaUrl('cover', 'thumb') }}">

        <h3 class="fs-6 fw-normal mb-1 text-body">{{ $game->name }}</h3>
        <span class="badge text-bg-{{ $game->status->type }}">{{ $game->status->name }}</span>
    </a>
</div>
