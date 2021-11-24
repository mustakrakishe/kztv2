<x-modal>
    <x-slot name="title">{{ __('Move device') }}</x-slot>
    <x-device-accounting.movements.create.form :statuses="$statuses" :movement="$device->last_movement" />
</x-modal>