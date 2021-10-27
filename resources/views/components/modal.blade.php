<div id="{{ $attributes->get('id') }}" class="modal fade" tabindex="-1" aria-hidden="true">

    <div {{ $attributes->class(["modal-dialog"])->filter(fn ($value, $key) => $key != 'id') }}>
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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