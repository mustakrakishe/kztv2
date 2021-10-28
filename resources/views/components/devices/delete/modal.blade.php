<x-modal id="device-delete-modal" class="modal-lg">
    <x-slot name="title">{{ __('Delete') }}</x-slot>

    <x-slot name="footer">
        <x-button class="btn-secondary toggle-modal" data-toggle="modal" data-target="#device-properties-modal" data-dismiss="modal">{{ __('actions.cancel') }}</x-button>
        <x-button class="btn-danger" form="device-delete-form">{{ __('actions.delete') }}</x-button>
    </x-slot>
</x-modal>