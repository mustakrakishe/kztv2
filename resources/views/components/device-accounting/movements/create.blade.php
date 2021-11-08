<x-modal id="device-properties-modal" class="modal-lg modal-fullscreen-lg-down">
    <x-slot name="title">{{ __('dialog.create.movement', ['entity' => trans('dialog.entities.movement')]) }}</x-slot>

    <form id="store" class="mt-3" action="{{ route('movements.store') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="date" class="form-label">{{ __('Date') }}</label>
            <input type="datetime-local" name="date" id="date" class="form-control">
        </div>

    </form>

    <x-slot name="footer">
        <x-button>{{ __('dialog.actions.apply') }}</x-button>
    </x-slot>
</x-modal>