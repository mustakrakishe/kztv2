<x-modal>
    <x-slot name="title">{{ __('New movement') }}</x-slot>

    <form id="movement-create-form" action="{{ route('devices.movements.store', ['device' => $movement->device_id]) }}" method="post">
        @csrf
        <x-device-accounting.movements.create.form.fields :movement="$movement" :statuses="$statuses"/>
    </form>

    <x-slot name="footer">
        <x-button class="btn-secondary" data-bs-dismiss="modal">{{ __('dialog.actions.cancel') }}</x-button>
        <x-button form="movement-create-form">{{ __('dialog.actions.ok') }}</x-button>
    </x-slot>
</x-modal>