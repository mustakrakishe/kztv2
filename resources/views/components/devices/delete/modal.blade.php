<x-modal id="device-delete-modal">
    <x-slot name="title">{{ __('Delete') }}</x-slot>

    <x-slot name="footer">
        <x-button class="btn-danger" form="device-delete-form" style="width: 100px;">{{ __('Yes') }}</x-button>
        <x-button class="btn-secondary toggle-modal" data-toggle="modal" data-target="#device-properties-modal" data-dismiss="modal" style="width: 100px;">{{ __('No') }}</x-button>
    </x-slot>
</x-modal>