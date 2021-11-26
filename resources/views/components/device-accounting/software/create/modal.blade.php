<x-modal>
    <x-slot name="title">{{ __('New software') }}</x-slot>

    <form class="device-special-actions" id="software-create-form" action="{{ route('devices.software.store', ['device' => $software->device_id]) }}" method="post">
        @csrf
        <x-device-accounting.software.create.form.fields :software="$software"/>
    </form>

    <x-slot name="footer">
        <x-button class="btn-secondary" data-bs-dismiss="modal">{{ __('dialog.actions.cancel') }}</x-button>
        <x-button form="software-create-form">{{ __('dialog.actions.ok') }}</x-button>
    </x-slot>
</x-modal>