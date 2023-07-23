<div class="col-3 col-lg-3 col-xxl-1">
    <a href="{{ route('downloadable_content.show', ['game' => $game, 'downloadable_content' => $dlc]) }}"
       class="text-decoration-none rounded"
    >
        <img alt="{{ $dlc->name }}" class="rounded mb-2" src="{{ $dlc->getFirstMediaUrl('cover', 'thumb') }}">

        <h3 class="fs-6 fw-normal mb-1 text-body">{{ $dlc->name }}</h3>
        <span class="badge text-bg-{{ $dlc->status->type }}">{{ $dlc->status->name }}</span>
    </a>
</div>
