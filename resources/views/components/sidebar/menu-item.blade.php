<li class="mb-1">

    <button class="btn btn-toggle align-items-center rounded collapsed shadow-none" data-bs-toggle="collapse" data-bs-target="#{{ $attributes->get('id') }}-collapse" aria-expanded="true">
        {{ $title }}
    </button>

    <div class="collapse show" id="{{ $attributes->get('id') }}-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            {{ $submenu }}
        </ul>
    </div>

</li>