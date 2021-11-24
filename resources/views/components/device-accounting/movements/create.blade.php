<x-modal id="create-movement-modal">
    <x-slot name="title">{{ __('Move') }}</x-slot>
    <x-device-accounting.movements.create.form :statuses="$statuses" :movement="$device->last_movement" />
    <x-slot name="footer">
        <x-button form="create-movement-form">{{ __('dialog.actions.apply') }}</x-button>
    </x-slot>
</x-modal>