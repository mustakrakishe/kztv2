<x-modal>
    <x-slot name="title">{{ __('New hardware') }}</x-slot>

    <form class="device-special-actions" id="hardware-create-form" action="{{ route('devices.hardware.store', ['device' => $hardware->device_id]) }}" method="post">
        @csrf
        <x-device-accounting.hardware.create.form.fields :hardware="$hardware"/>
    </form>

    <x-slot name="footer">
        <x-button class="btn-secondary" data-bs-dismiss="modal">{{ __('dialog.actions.cancel') }}</x-button>
        <x-button form="hardware-create-form">{{ __('dialog.actions.ok') }}</x-button>
    </x-slot>
</x-modal>