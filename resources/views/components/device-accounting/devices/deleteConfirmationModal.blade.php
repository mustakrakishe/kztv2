<x-modal id="device-delete-modal">
    <x-slot name="title">{{ __('Delete') }}</x-slot>

    <p class="card-text">
        {{ __('dialog.delete.message', ['entity' => trans('device')]) }}
    </p>

    <x-slot name="footer">
        <form action="{{ route('devices.destroy', ['device' => '#']) }}" method="post">
            @csrf
            @method('delete')
            <x-button class="btn-danger" data-bs-dismiss="modal">{{ __('Yes') }}</x-button>
        </form>

        <x-button class="btn-secondary" data-bs-dismiss="modal">{{ __('No') }}</x-button>
    </x-slot>
</x-modal>