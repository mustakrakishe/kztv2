@props(['movement'])

<tr {{ $attributes->merge(['style' => 'cursor: pointer;']) }}>
    <td class="align-bottom">
        <input type="datetime-local" name="date" class="form-control" value="{{ str_replace(' ', 'T', $movement->date) }}">
    </td>
    <td class="align-bottom">
        <input type="text" name="location" class="form-control" value="{{ $movement->location }}">
    </td>
    <td class="align-bottom">
        <input type="text" name="comment" class="form-control" value="{{ $movement->comment }}">
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
    </td>
</tr>
{{--
    <x-button type="button" class="delete-movement btn-danger" style="width: 50px;">
        <i class="fas fa-trash-alt"></i>
    </x-button>
--}}