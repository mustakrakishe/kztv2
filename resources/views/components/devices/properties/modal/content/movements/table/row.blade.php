<tr name="movement">
    <td>
        <input type="datetime-local" name="date" class="form-control" form="update-movement-{{ $movement->id }}" value="{{ str_replace(' ', 'T', $movement->date) }}">
    </td>
    <td>
        <input type="text" name="location" class="form-control" form="update-movement-{{ $movement->id }}" value="{{ $movement->location }}">
    </td>
    <td>
        <input type="text" name="comment" class="form-control" form="update-movement-{{ $movement->id }}" value="{{ $movement->comment }}">
    </td>

    <td name="actions">
        <div name="init" class="row mx-0">
            <x-button class="btn-secondary col" style="width: 50px;">
                <i class="fas fa-pen"></i>
            </x-button>
            
            <x-button name="delete-movement" class="btn-danger col ml-2" style="width: 50px;">
                <i class="fas fa-trash-alt"></i>
            </x-button>
        </div>
        
        <div name="confirm-delete" hidden="hidden">
            <div class="row justify-content-center">{{ __('Confirm action.') }}</div>

            <form name="delete-movement" action="{{ route('devices.movements.destroy', ['device' => $movement->device_id, 'movement' => $movement->id]) }}" method="post">
                @csrf
                @method('delete')
                <div class="row mx-0">
                    <x-button class="btn-danger col" style="width: 50px;">
                        <i class="fas fa-trash-alt"></i>
                    </x-button>

                    <x-button type="reset" class="btn-secondary col ml-2" style="width: 50px;">
                        <i class="fas fa-ban"></i>
                    </x-button>
                </div>
            </form>
        </div>
        
        <div name="edit" hidden="hidden">
            <form id="update-movement-{{ $movement->id }}" name="update-movement" action="{{ route('devices.movements.update', ['device' => $movement->device_id, 'movement' => $movement->id]) }}" method="post">
                @csrf
                @method('put')
                <div class="row mx-0">
                    <x-button class="col" style="width: 50px;">
                        <i class="fas fa-check"></i>
                    </x-button>

                    <x-button type="reset" class="btn-secondary col ml-2" style="width: 50px;">
                        <i class="fas fa-ban"></i>
                    </x-button>
                </div>
            </form>
        </div>
    </td>
</tr>