<x-modal id="device-delete-modal">
    <x-slot name="title">{{ __('dialog.delete.header', ['entity' => trans('dialog.entities.device')]) }}</x-slot>

    <p class="card-text">
        {{ __('dialog.delete.message', ['entity' => trans('dialog.entities.device')]) }}
    </p>

    <x-slot name="footer">
        <form id="delete" action="{{ route('devices.destroy', ['device' => '#']) }}" method="post">
            @csrf
            @method('delete')
            <x-button class="btn-danger" data-bs-dismiss="modal">{{ __('Yes') }}</x-button>
        </form>

        <x-button class="btn-secondary" data-bs-dismiss="modal">{{ __('No') }}</x-button>
    </x-slot>
</x-modal>