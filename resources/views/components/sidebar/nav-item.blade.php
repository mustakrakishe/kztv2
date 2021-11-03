<li class="nav-item">

    @if(!isset($submenu))
    <a href="{{ $attributes }}" class="nav-link">
        <p>
            {{ $title }}

            @isset($submenu)
            <i class="fas fa-angle-left right"></i>
            @endisset

            @isset($badge)
            <span class="badge badge-info right">{{ $badge }}</span>
            @endisset
        </p>
    </a>

    @else
    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        {{ $title }}
    </button>

    <ul id="{{ $title }}" class="collapse">
        {{ $submenu }}
    </ul>
    @endif
</li>