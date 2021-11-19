<div id="{{ $attributes->get('id') }}" class="modal fade" tabindex="-1" aria-hidden="true">

    <div {{ $attributes->class(["modal-dialog"])->filter(fn ($value, $key) => $key != 'id') }}>
        <div class="modal-content h-100">

            <div class="modal-header">
                {{ $title }}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $slot }}
            </div>

            @isset($footer)
            <div class="modal-footer">
                {{ $footer }}
            </div>
            @endisset
        </div>
    </div>

</div>